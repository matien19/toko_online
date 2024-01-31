<?php

namespace App\Controllers;

class Etalase extends BaseController
{
    private $url ='https://api.rajaongkir.com/starter/';
    private $apiKey ='bf4c871ca02b57bed1765f0a6a607f6d';
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    public function index()
    {
        $barang = new \App\Models\BarangModel();
        $model = $barang->findAll();
        return view('etalase/index',[
            'model'=>$model,
        ]);
    }

    public function beli()
    {
        $id = $this->request->uri->getSegment(3);
        $barang = new \App\Models\BarangModel();
        $model = $barang->find($id);

        if ($this->request->getPost()) 
        {
            $data = $this->request->getPost();
            $this->validation->run($data, 'transaksi');
            $errors = $this->validation->getErrors();
            if ((!$errors))
            {
                //ambil modeel transaksi
                $transaksiModel = new \App\Models\TransaksiModel();
                $transaksi = new \App\Entities\Transaksi();

                //update barang 
                $barangModel = new \App\Models\BarangModel();
                $jumlah_pembelian = $this->request->getPost('jumlah');
                $id_barang = $this->request->getPost('id_barang');
                $barang = $barangModel->find($id_barang);
                $entityBarang = new \App\Entities\Barang();
                $entityBarang->stok = $barang->stok-$jumlah_pembelian;
                $entityBarang->id = $id_barang;
                $entityBarang->update_by = $this->session->get('id');;
                $entityBarang->update_date = date('Y-m-d H:i:s');
                $barangModel->save($entityBarang);

                //simpan data transaksi
                $transaksi->fill($data);
                $transaksi->status = 0;
                $transaksi->created_by = $this->session->get('id');;
                $transaksi->created_date = date('Y-m-d H:i:s');

                $transaksiModel->save($transaksi);
                
                $id = $transaksiModel->insertID();
                
                $segments =['transaksi', 'view', $id];
                return redirect()->to(site_url($segments));

            }
        }

        $provinsi = $this->rajaongkir('province');
        return view('etalase/beli',[
            'model'=>$model,
            'provinsi'=>json_decode($provinsi)->rajaongkir->results,

        ]);
    }
    public function getCity()
    {
        if($this->request->isAJAX())
        {
            $id_province = $this->request->getGet('id_province');
            $data = $this->rajaongkir('city', $id_province);

            return $this->response->setJSON($data);

        }
        
    }
    public function getCost()
    {
        if($this->request->isAJAX())
        {
            $origin = $this->request->getGet('origin');
            $destination = $this->request->getGet('destination');
            $weight = $this->request->getGet('weight');
            $courier = $this->request->getGet('courier');
            $data = $this->rajaongkircost($origin, $destination, $weight, $courier);

            return $this->response->setJSON($data);

        }
        
    }
    private function rajaongkircost($origin, $destination, $weight, $courier )
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=".$origin."&destination=".$destination."&weight=".$weight."&courier=".$courier,
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: ".$this->apiKey,
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        return $response;
    }
    private function rajaongkir($method, $id_province=null)
    {
        $endPoint = $this->url.$method;
        if($id_province!=null)
        {
            $endPoint = $endPoint."?province=".$id_province;
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $endPoint,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: ".$this->apiKey
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        return $response;
    }
}
