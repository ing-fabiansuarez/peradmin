<?php

namespace App\Entities;

use App\Models\CustomerModel;
use App\Models\DetailorderModel;
use App\Models\EmployeeModel;
use App\Models\InfoAdressModel;
use App\Models\ProductionFormatModel;
use App\Models\ProductionlineModel;
use App\Models\ProductModel;
use App\Models\ReceiptModel;
use App\Models\TypeorderModel;
use CodeIgniter\Entity\Entity;

class Order extends Entity
{
    protected $dates = ['created_at_order'];
    private $mdlDetailOrder, $mdlLineProduction, $mdlProductionFormat, $mdlInfoAdress, $mdlProduct, $mdlReceipt;

    public function __construct()
    {
        $this->mdlDetailOrder = new DetailorderModel();
        $this->mdlLineProduction = new ProductionlineModel();
        $this->mdlProductionFormat = new ProductionFormatModel();
        $this->mdlInfoAdress = new InfoAdressModel();
        $this->mdlProduct = new ProductModel();
        $this->mdlReceipt = new ReceiptModel();
    }

    public function setInfoAdress($transporter, $city, $whtapp, $email, $neighborhood, $homeadress)
    {
        $mdlInfoAdress = new InfoAdressModel();
        $this->attributes['info_adress_id'] = $mdlInfoAdress->insert([
            'transporter_id' => $transporter,
            'city_id' => $city,
            'whatsapp_infoadress' => $whtapp,
            'email_infoadress' => $email,
            'neighborhood_infoadress' => $neighborhood,
            'home_infoadress' => $homeadress
        ]);
        return $this;
    }

    public function getCreatedByNameComplete()
    {
        $mdlEmployee = new EmployeeModel();
        $employee = $mdlEmployee->find($this->created_by_order);
        return $employee->name_employee . ' ' . $employee->surname_employee;
    }

    public function getCustomer()
    {
        $mdlCustomer = new CustomerModel();
        return $mdlCustomer->find($this->customer_id);
    }

    public function getInfoAdress()
    {
        return $this->mdlInfoAdress->table('info_adress')
            ->select('city_id,whatsapp_infoadress,email_infoadress,neighborhood_infoadress,home_infoadress,name_city,name_department,name_transporter,id_transporter')
            ->join('city', 'info_adress.city_id = city.id_city')
            ->join('department', 'city.department_id = department.id_department')
            ->join('transporter', 'info_adress.transporter_id = transporter.id_transporter')
            ->where('info_adress.id_infoadress', $this->info_adress_id)
            ->get()->getFirstRow('array');
    }

    public function addDetail($product_id, $reference, $observation, $size_id, $price)
    {
        return $this->mdlDetailOrder->insert([
            'order_id' => $this->attributes['id_order'],
            'reference_num' => $reference,
            'reference_product_id' => $product_id,
            'observation' => $observation,
            'pricesale_detailorder' => $price,
            'size_id' => $size_id
        ]);
    }

    public function getDetailList()
    {
        return $this->mdlDetailOrder->db->table('detailorder')
            ->select('*')
            ->join('product', 'detailorder.reference_product_id = product.id_product')
            ->join('reference', 'detailorder.reference_num = reference.num_reference AND detailorder.reference_product_id = reference.product_id')
            ->join('size', 'detailorder.size_id = size.id_size')
            ->where('detailorder.order_id', $this->id_order)
            ->get()->getResultArray();
    }

    public function getDetailListClothes()
    {
        return $this->mdlDetailOrder->db->table('detailorder')
            ->select('*')
            ->join('product', 'detailorder.reference_product_id = product.id_product')
            ->join('reference', 'detailorder.reference_num = reference.num_reference AND detailorder.reference_product_id = reference.product_id')
            ->join('size', 'detailorder.size_id = size.id_size')
            ->where('detailorder.order_id', $this->id_order)
            ->where('product.production_line_id', 2)
            ->get()->getResultArray();
    }

    public function getDetailListShoes()
    {
        return $this->mdlDetailOrder->db->table('detailorder')
            ->select('*')
            ->join('product', 'detailorder.reference_product_id = product.id_product')
            ->join('reference', 'detailorder.reference_num = reference.num_reference AND detailorder.reference_product_id = reference.product_id')
            ->join('size', 'detailorder.size_id = size.id_size')
            ->where('detailorder.order_id', $this->id_order)
            ->where('product.production_line_id', 1)
            ->get()->getResultArray();
    }

    public function getDetailListByLineProduction($id_line_production)
    {
        return $this->mdlDetailOrder->db->table('detailorder')
            ->select('*')
            ->join('product', 'detailorder.reference_product_id = product.id_product')
            ->join('reference', 'detailorder.reference_num = reference.num_reference AND detailorder.reference_product_id = reference.product_id')
            ->join('size', 'detailorder.size_id = size.id_size')
            ->where('detailorder.order_id', $this->id_order)
            ->where('product.production_line_id', $id_line_production)
            ->orderBy('product.name_product', 'asc')
            ->get()->getResultArray();
    }

    public function getTotalSale()
    {
        $detailOrder = $this->getDetailList();
        $total = 0;
        foreach ($detailOrder as $detail) :
            $total += $detail['pricesale_detailorder'];
        endforeach;
        return $total;
    }

    public function getCountEachProduct() //retorna el nombre y la cantidad de productos que hay y el precio total por ellos
    {
        $detailOrder = $this->getDetailList();
        $arrayResult = array();
        foreach ($this->mdlProduct->select('id_product,name_product')->findAll() as $product) {
            $counter = 0;
            $value = 0;

            foreach ($detailOrder as $detail) :
                if ($detail['reference_product_id'] == $product['id_product']) :
                    $counter += 1;
                    $value += $detail['pricesale_detailorder'];
                endif;
            endforeach;
            if ($counter != 0) {
                array_push($arrayResult, [
                    'id_product' => $product['id_product'],
                    'name_product' => $product['name_product'],
                    'quantity' => $counter,
                    'value' => $value,
                ]);
            }
        }
        return ($arrayResult);
    }

    public  function getLineProductions()
    {
        $arrayResult = array();
        foreach ($this->mdlLineProduction->findAll() as $row) {
            if ($this->mdlDetailOrder->db->table('detailorder')
                ->select('*')
                ->join('product', 'detailorder.reference_product_id = product.id_product')
                ->where('detailorder.order_id', $this->id_order)
                ->where('product.production_line_id', $row['id_productionline'])
                ->get()->getFirstRow()
            ) {
                array_push($arrayResult, $row);
            }
        }
        return $arrayResult;
    }

    public function getProductionFormat()
    {
        return $this->mdlProductionFormat->db->table('production_format')
            ->select('*')
            ->join('production_line', 'production_format.production_line_id_productionline = production_line.id_productionline')
            ->where('production_format.order_id_order', $this->id_order)
            ->get()
            ->getResultArray();
    }

    public function getTypeOrder()
    {
        $this->mdlTypeOrder = new TypeorderModel();
        return $this->mdlTypeOrder->find($this->type_of_order_id);
    }

    public function genereteProductionFormat($id_lineProduction, $dateProduction)
    {
        return $this->mdlProductionFormat->insert([
            'order_id_order' => $this->id_order,
            'production_line_id_productionline' => $id_lineProduction,
            'date_production' => $dateProduction,
            'print' => 0,
            'print_at_format' => null,
            'created_at_format' => date("Y-m-d H:i:s"),
            'created_by_format' => session()->get('cedula_employee'),
            'print_by_format' => null,
        ]);
    }

    public function isProduction()
    {
        if (!$this->mdlProductionFormat->where('order_id_order', $this->id_order)->findAll()) {
            return false;
        }
        return true;
    }

    public function getReceipts()
    {
        return $this->mdlReceipt->where('order_id', $this->id_order)->orderBy('consecutive_receipt')->get()->getResultArray();
    }
}
