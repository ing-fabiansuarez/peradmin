<?php

namespace App\Controllers\GenerateReport;

use App\Controllers\BaseController;
use App\Models\DetailorderModel;
use App\Models\OrderModel;
use App\Models\ProductionFormatModel;
use App\Models\ProductionlineModel;
use App\Models\TypeProductionModel;
use FPDF;
use Mpdf\Mpdf;

class ListsProduction extends BaseController
{
    public function __construct()
    {
        //inicializacion de los modelos
        $this->mdlOrder = new OrderModel();
        $this->mdlFormatProduction = new ProductionFormatModel();
        $this->mdlLineProduction = new ProductionlineModel();
        $this->mdlTypeProduction = new TypeProductionModel();
        $this->mdlDetailOrder = new DetailorderModel();
    }
    public function generateListProduction()
    {
        $id_order = $this->request->getPost('id_order');
        $id_line_production = $this->request->getPost('line_production');
        //consulta del pedido
        if (!$order = $this->mdlOrder->find($id_order)) {
            echo "EL PEDIDO NO EXITE";
        }
        if (!$order->isProduction()) {
            echo "EL PEDIDO NO ESTA EN PRODUCCION NO SE PUEDE IMPRIMIR ROTULO";
            return;
        }
        if (!$formatProd = $this->mdlFormatProduction->getProductionFormat($id_order, $id_line_production)) {
            echo "NO EXITE EL FORMATO DE PRODUCCION";
            return;
        }
        $formatProd['print'] = true;
        $formatProd['print_at_format'] = date("Y-m-d H:i:s");
        $formatProd['print_by_format'] = session()->get('cedula_employee');
        $this->mdlFormatProduction
            ->where('order_id_order', $formatProd['order_id_order'])
            ->where('production_line_id_productionline', $formatProd['production_line_id_productionline'])
            ->set($formatProd)
            ->update();

        //TABLA DE TODO EL PEDIDO

        //Cuerpo

        switch ($id_line_production) {
            case 1:
                $pdf = new ListProductionShoes('P', 'mm', array(215, 280));
                //Establecemos el margen inferior:
                $pdf->SetAutoPageBreak(true, 8);
                $pdf->AddPage();

                $pdf->SetAligns(array('C', 'C', 'L', 'C', 'L', 'L', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
                $pdf->SetFont('Arial', '', 12);
                $numrow = 1;
                foreach ($order->getDetailListShoes() as $row) {
                    $pdf->Row([
                        $numrow,
                        utf8_decode($row['reference_num']),
                        utf8_decode($row['name_reference']),
                        utf8_decode($row['name_size']),
                        utf8_decode($row['name_product']),
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                    ], 7, true);
                    $numrow += 1;
                }
                break;
            case 2:
                $pdf = new ListProductionClothes('P', 'mm', array(215, 280));
                //Establecemos el margen inferior:
                $pdf->SetAutoPageBreak(true, 8);
                $pdf->AddPage();
                $pdf->SetAligns(array('C', 'C', 'L', 'C', 'L', 'L', 'C', 'C', 'C', 'C', 'C', 'C'));
                $pdf->SetFont('Arial', '', 12);
                $numrow = 1;
                foreach ($order->getDetailListClothes() as $row) {
                    $pdf->Row([
                        $numrow,
                        utf8_decode($row['reference_num']),
                        utf8_decode($row['name_reference']),
                        utf8_decode($row['name_size']),
                        utf8_decode($row['name_product']),
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                    ], 7, true);
                    $numrow += 1;
                }
                break;
            default:
                $pdf = new ListProductionGeneric('P', 'mm', array(215, 280));
                //Establecemos el margen inferior:
                $pdf->SetAutoPageBreak(true, 8);
                $pdf->AddPage();
                $pdf->SetAligns(array('C', 'C', 'L', 'C', 'L', 'L', 'C'));
                $pdf->SetFont('Arial', '', 12);
                $numrow = 1;
                foreach ($order->getDetailListByLineProduction($id_line_production) as $row) {
                    $pdf->Row([
                        $numrow,
                        utf8_decode($row['reference_num']),
                        utf8_decode($row['name_reference']),
                        utf8_decode($row['name_size']),
                        utf8_decode($row['name_product']),
                        utf8_decode($row['observation']),
                        '',
                    ], 7, true);
                    $numrow += 1;
                }
                break;
        }

        //el cuadro de dialogo donde se dice de que linea de produccion esta compuesto
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->MultiCell(0, 10, utf8_decode('Este pedido contiene: '), 'TLR', 'C');
        $pdf->SetFont('Arial', '', 12);
        foreach ($order->getProductionFormat() as $format) {
            $pdf->Cell(0, 5, utf8_decode($format['name_productionline'] . ' al ' . $format['name_typeproduction'] . ' con salida de producción ' . $format['date_production']), 'LR', 1, 'C');
        }
        $pdf->Cell(0, 1, '', 'LRB', 1, 'C');
        //------------------------------------------
        $pdf->AliasNbPages();
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output();
    }

    public function generateGraphDailyProduction()
    {

        //datos recibidos desde el formulario de view production
        $date = $this->request->getGet('date');
        $idLineProduction = $this->request->getGet('line_production');
        $idTypeProduction =  $this->request->getGet('type_production');

        ($formatProdutions =   $this->mdlFormatProduction->getObjectDailyFormatsProductions($date, $idLineProduction, $idTypeProduction));

        $lineProduction =  $this->mdlLineProduction->find($idLineProduction);
        $typeProduction =  $this->mdlTypeProduction->find($idTypeProduction);


        //DECLARACON DEL MPDF
        $mpdf = new Mpdf();


        // Write some HTML code:
        $mpdf->WriteHTML(view('reports/html_report_daily', [
            'date' => $date,
            'porductionFormats' => $formatProdutions,
            'lineProduction' => $lineProduction,
            'typeProduction' => $typeProduction
        ]));

        // Output a PDF file directly to the browser
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output();
    }

    public function generateListProductsDaily()
    {
        //datos recibidos desde el formulario
        $date = $this->request->getPostGet('date');
        $idLineProduction = $this->request->getPostGet('line_production');
        $idTypeProduction =  $this->request->getPostGet('type_production');

        $pdf = new ListProductsDaily('P', 'mm', array(215, 280));
        $pdf->AddPage();


        //___________________________________________________
        $counter = 0;
        foreach ($this->mdlDetailOrder->getListDailyProducts($date, $idLineProduction, $idTypeProduction) as $item) {
            $counter += 1;
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(10, 6, $counter, 'LRT', 0, 'C');
            $pdf->Cell(50, 6, utf8_decode($item['reference_num'] . ' - ' . $item['name_reference']), 1, 0, 'C');
            $pdf->Cell(50, 6, utf8_decode($item['name_product']), 1, 0, 'C');
            $pdf->Cell(20, 6, utf8_decode($item['name_size']), 1, 0, 'C');
            $pdf->Cell(12.4, 6, '', 1, 0, 'C');
            $pdf->Cell(12.4, 6, '', 1, 0, 'C');
            $pdf->Cell(12.4, 6, '', 1, 0, 'C');
            $pdf->Cell(12.4, 6, '', 1, 0, 'C');
            $pdf->Cell(12.4, 6, '', 1, 1, 'C');
            $pdf->Cell(10, 6, '', 'BLR', 0, 'C');
            $pdf->Cell(182, 6, $item['name_customer'] . ' ' . $item['surname_customer'] . ' ---- Recep: ' . $item['name_employee'] . ' ' . $item['surname_employee'], 1, 1, 'L');
            $pdf->Ln(5);
        }
        //------------------------------------------
        $pdf->AliasNbPages();
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output();
    }
}
class CustomPDF extends FPDF
{
    var $widths;
    var $aligns;

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns = $a;
    }

    function Row($data, $alt = 7, $border = false)
    {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $alt * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            if ($border) {
                $this->Rect($x, $y - 1, $w, $h);
            }
            //Print the text
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
        return $h;
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
}

class ListProductsDaily extends CustomPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('img/corporative/logopera.png', 175, 7, 20);

        $this->SetFont('Arial', 'B', 14);
        // Move to the right

        //modelos
        $mdlLineProduction = new ProductionlineModel();

        $date = $_POST['date'];
        $idLineProduction = $_POST['line_production'];

        $lineProduction = $mdlLineProduction->find($idLineProduction);

        // Title
        $this->Cell(192, 4, utf8_decode('FORMATO DIARIO DEL DETAL - ' . $lineProduction['name_productionline']), 0, 1, 'C');
        $this->Ln(2);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(30);
        $this->Cell(132, 5, 'FECHA: ' . $date, 1, 1, 'C');
        $this->Cell(30);
        $this->Cell(66, 5, 'Guarnecedor: ', 1, 0, 'L');
        $this->Cell(66, 5, 'Montador: ', 1, 1, 'L');
        $this->Ln(5);

        //encabezado de la tabla
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 7, '#', 1, 0, 'C');
        $this->Cell(50, 7, 'Referencia', 1, 0, 'C');
        $this->Cell(50, 7, 'Producto', 1, 0, 'C');
        $this->Cell(20, 7, 'Talla', 1, 0, 'C');
        $this->Cell(12.4, 7, utf8_decode('Cr'), 1, 0, 'C');
        $this->Cell(12.4, 7, utf8_decode('Am'), 1, 0, 'C');
        $this->Cell(12.4, 7, utf8_decode('Cs'), 1, 0, 'C');
        $this->Cell(12.4, 7, utf8_decode('Bl'), 1, 0, 'C');
        $this->Cell(12.4, 7, utf8_decode('Mn'), 1, 1, 'C');
        $this->Ln(3);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-10);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 10);
        // Número de página
        $this->Cell(50, 10, 'Pagina ' . $this->PageNo() . ' de {nb}', 0, 0, 'C');
        $this->Cell(145, 10, 'Impreso por ' . session()->get('name_employee') . ' (' . session()->get('cedula_employee') . ') el ' . date("Y-m-d H:i:s"), 0, 0, 'C');
    }
}

class ListProductionShoes extends CustomPDF
{
    // Page header
    function Header()
    {
        //modelos
        $mdlFormatProduction = new ProductionFormatModel();
        $mdlorder = new OrderModel();

        // Logo
        $this->Image('img/corporative/logopera.png', 185, 5, 15);

        //datos
        $id_order = $_POST['id_order'];
        $id_line_production = $_POST['line_production'];

        //linea de produccion y pedido
        $formatProduction = $mdlFormatProduction->getProductionFormat($id_order, $id_line_production);
        $order = $mdlorder->find($id_order);

        $this->SetFont('Arial', 'B', 14);
        // Move to the right

        // Title
        $this->Cell(192, 4, utf8_decode('  FORMATO DE PRODUCCIÓN DE ' . $formatProduction['name_productionline']), 0, 1, 'C');
        $this->Cell(192, 8, utf8_decode($order->id_order . '-' . $id_line_production), 0, 1, 'C');
        $customer = $order->getCustomer();

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(45, 5, utf8_decode('FECHA DE CREACIÓN: '), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(42, 5, utf8_decode($order->created_at_order), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(45, 5,  utf8_decode('FECHA DE PRODUCCIÓN: '), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(35, 5, utf8_decode($formatProduction['date_production']), 0, 1, 'R');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 5, utf8_decode('CLIENTE: '), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(85, 5, utf8_decode($customer->name_customer . ' ' . $customer->surname_customer), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 5, utf8_decode('DESTINO: '), 0, 0, 'L');
        $infoAdress = $order->getInfoAdress();
        $this->SetFont('Arial', '', 10);
        $this->Cell(70, 5, utf8_decode($infoAdress['name_city'] . ' - ' . $infoAdress['name_department']), 0, 1, 'L');

        $this->ln(3);

        $this->Cell(43, 5, 'Supervisor:', 1, 0, 'L');
        $this->Cell(43, 5, utf8_decode('Sublimación:'), 1, 0, 'L');
        $this->Cell(43, 5, 'Troquel:', 1, 0, 'L');
        $this->Cell(43, 5, 'Bodega:', 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 5, 'TOTAL', 1, 1, 'C');

        $this->SetFont('Arial', '', 10);
        $this->Cell(43, 5, 'Armado:', 1, 0, 'L');
        $this->Cell(43, 5, utf8_decode('Guarnecedor:'), 1, 0, 'L');
        $this->Cell(43, 5, 'Montador:', 1, 0, 'L');
        $this->Cell(43, 5, 'Calidad:', 1, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 5, count($order->getDetailListShoes()), 1, 1, 'C');

        $this->Ln(2);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(195, 4, 'Pagina ' . $this->PageNo() . ' de {nb}', 0, 1, 'C');
        $this->Ln(2);

        switch ($id_line_production) {
            case 1:
                //encabezado de la tabla
                $this->SetWidths(array(8, 15, 50, 12, 40, 35, 5, 5, 5, 5, 5, 5, 5));
                $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
                $this->SetFont('Arial', 'B', 10);
                $this->Row([utf8_decode('N°'), 'Ref', 'Nombre Ref', 'Talla', 'Producto', utf8_decode('Observación'), 'S', 'T', 'A', 'G', 'B', 'M', 'C'], 7, true);
                break;
            case 2:
                //encabezado de la tabla
                $this->SetWidths(array(8, 15, 45, 15, 40, 11, 11, 11, 11, 11, 11, 11));
                $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
                $this->SetFont('Arial', 'B', 10);
                $this->Row([utf8_decode('N°'), 'Ref', 'Nombre Ref', 'Talla', 'Producto', 'Subl', 'File', 'Caus', 'Coll', 'Marq', 'Cali', 'Bols'], 7, true);
                break;
            default:
                //encabezado de la tabla
                $this->SetWidths(array(8, 15, 50, 20, 45, 40, 15,));
                $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C'));
                $this->SetFont('Arial', 'B', 10);
                $this->Row([utf8_decode('N°'), 'Ref', 'Nombre Ref', 'Talla', 'Producto', utf8_decode('Observación'), 'Check'], 7, true);
                break;
        }
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-10);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 10);
        // Número de página
        $this->Cell(50, 10, 'Pagina ' . $this->PageNo() . ' de {nb}', 0, 0, 'C');
        $this->Cell(145, 10, 'Impreso por ' . session()->get('name_employee') . ' (' . session()->get('cedula_employee') . ') el ' . date("Y-m-d H:i:s"), 0, 0, 'C');
    }
}

class ListProductionClothes extends CustomPDF
{
    // Page header
    function Header()
    {
        //modelos
        $mdlFormatProduction = new ProductionFormatModel();
        $mdlorder = new OrderModel();

        // Logo
        $this->Image('img/corporative/logopera.png', 185, 5, 15);

        //datos
        $id_order = $_POST['id_order'];
        $id_line_production = $_POST['line_production'];

        //linea de produccion y pedido
        $formatProduction = $mdlFormatProduction->getProductionFormat($id_order, $id_line_production);
        $order = $mdlorder->find($id_order);

        $this->SetFont('Arial', 'B', 14);
        // Move to the right

        // Title
        $this->Cell(192, 4, utf8_decode('  FORMATO DE PRODUCCIÓN DE ' . $formatProduction['name_productionline']), 0, 1, 'C');
        $this->Cell(192, 8, utf8_decode($order->id_order . '-' . $id_line_production), 0, 1, 'C');
        $customer = $order->getCustomer();

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(45, 5, utf8_decode('FECHA DE CREACIÓN: '), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(42, 5, utf8_decode($order->created_at_order), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(45, 5,  utf8_decode('FECHA DE PRODUCCIÓN: '), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(35, 5, utf8_decode($formatProduction['date_production']), 0, 1, 'R');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 5, utf8_decode('CLIENTE: '), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(85, 5, utf8_decode($customer->name_customer . ' ' . $customer->surname_customer), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 5, utf8_decode('DESTINO: '), 0, 0, 'L');
        $infoAdress = $order->getInfoAdress();
        $this->SetFont('Arial', '', 10);
        $this->Cell(70, 5, utf8_decode($infoAdress['name_city'] . ' - ' . $infoAdress['name_department']), 0, 1, 'L');

        $this->ln(3);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(43, 5, 'TOTAL PRENDAS:', 1, 0, 'L');

        $this->Cell(20, 5,  count($order->getDetailListClothes()), 1, 1, 'C');

        $this->Ln(2);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(195, 4, 'Pagina ' . $this->PageNo() . ' de {nb}', 0, 1, 'C');
        $this->Ln(2);

        //encabezado de la tabla
        $this->SetWidths(array(8, 12, 45, 24, 45, 9, 9, 9, 9, 9, 9, 9));
        $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
        $this->SetFont('Arial', 'B', 10);
        $this->Row([utf8_decode('N°'), 'Ref', 'Nombre Ref', 'Talla', 'Producto', 'Sub', 'Fil', 'Cau', 'Col', 'Mar', 'Cal', 'Bol'], 7, true);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-10);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 10);
        // Número de página
        $this->Cell(50, 10, 'Pagina ' . $this->PageNo() . ' de {nb}', 0, 0, 'C');
        $this->Cell(145, 10, 'Impreso por ' . session()->get('name_employee') . ' (' . session()->get('cedula_employee') . ') el ' . date("Y-m-d H:i:s"), 0, 0, 'C');
    }
}

class ListProductionGeneric extends CustomPDF
{
    // Page header
    function Header()
    {
        //modelos
        $mdlFormatProduction = new ProductionFormatModel();
        $mdlorder = new OrderModel();

        // Logo
        $this->Image('img/corporative/logopera.png', 185, 5, 15);

        //datos
        $id_order = $_POST['id_order'];
        $id_line_production = $_POST['line_production'];

        //linea de produccion y pedido
        $formatProduction = $mdlFormatProduction->getProductionFormat($id_order, $id_line_production);
        $order = $mdlorder->find($id_order);

        $this->SetFont('Arial', 'B', 14);
        // Move to the right

        // Title
        $this->Cell(192, 4, utf8_decode('  FORMATO DE PRODUCCIÓN DE ' . $formatProduction['name_productionline']), 0, 1, 'C');
        $this->Cell(192, 8, utf8_decode($order->id_order . '-' . $id_line_production), 0, 1, 'C');
        $customer = $order->getCustomer();

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(45, 5, utf8_decode('FECHA DE CREACIÓN: '), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(42, 5, utf8_decode($order->created_at_order), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(45, 5,  utf8_decode('FECHA DE PRODUCCIÓN: '), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(35, 5, utf8_decode($formatProduction['date_production']), 0, 1, 'R');

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 5, utf8_decode('CLIENTE: '), 0, 0, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(85, 5, utf8_decode($customer->name_customer . ' ' . $customer->surname_customer), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 5, utf8_decode('DESTINO: '), 0, 0, 'L');
        $infoAdress = $order->getInfoAdress();
        $this->SetFont('Arial', '', 10);
        $this->Cell(70, 5, utf8_decode($infoAdress['name_city'] . ' - ' . $infoAdress['name_department']), 0, 1, 'L');

        $this->ln(3);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(43, 5, 'TOTAL PRENDAS:', 1, 0, 'L');

        $this->Cell(20, 5,  count($order->getDetailListByLineProduction($id_line_production)), 1, 1, 'C');

        $this->Ln(2);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(195, 4, 'Pagina ' . $this->PageNo() . ' de {nb}', 0, 1, 'C');
        $this->Ln(2);

        switch ($id_line_production) {
            case 1:
                //encabezado de la tabla
                $this->SetWidths(array(8, 15, 50, 12, 40, 35, 5, 5, 5, 5, 5, 5, 5));
                $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
                $this->SetFont('Arial', 'B', 10);
                $this->Row([utf8_decode('N°'), 'Ref', 'Nombre Ref', 'Talla', 'Producto', utf8_decode('Observación'), 'S', 'T', 'A', 'G', 'B', 'M', 'C'], 7, true);
                break;
            case 2:
                //encabezado de la tabla
                $this->SetWidths(array(8, 15, 45, 15, 40, 11, 11, 11, 11, 11, 11, 11));
                $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
                $this->SetFont('Arial', 'B', 10);
                $this->Row([utf8_decode('N°'), 'Ref', 'Nombre Ref', 'Talla', 'Producto', 'Subl', 'File', 'Caus', 'Coll', 'Marq', 'Cali', 'Bols'], 7, true);
                break;
            default:
                //encabezado de la tabla
                $this->SetWidths(array(8, 15, 50, 20, 45, 40, 15,));
                $this->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C'));
                $this->SetFont('Arial', 'B', 10);
                $this->Row([utf8_decode('N°'), 'Ref', 'Nombre Ref', 'Talla', 'Producto', utf8_decode('Observación'), 'Check'], 7, true);
                break;
        }
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-10);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 10);
        // Número de página
        $this->Cell(50, 10, 'Pagina ' . $this->PageNo() . ' de {nb}', 0, 0, 'C');
        $this->Cell(145, 10, 'Impreso por ' . session()->get('name_employee') . ' (' . session()->get('cedula_employee') . ') el ' . date("Y-m-d H:i:s"), 0, 0, 'C');
    }
}
