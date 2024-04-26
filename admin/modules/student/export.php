<?php


$listAllstudent = getRaw("SELECT * FROM student");
$dataStudent = json_encode($listAllstudent);

$studentFinal = json_decode($dataStudent,true);


require_once './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory; 
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$spreadsheet->getDefaultStyle()
            ->getFont()
            ->setName('Arial')
            ->setSize(10);

$tableHead = [
   'font' => [
      'color' => [
         'rgb' => 'FFFFFF'
      ],
      'bold'=> true,
      'size'=> 10
      ],
      'fill' => [
         'fillType' => Fill::FILL_SOLID,
         'startColor' => [
            'rgb' => "538ED5",
         ]
         ]
];

//even row
$evenRow = [
   'fill' => [
      'fillType' => Fill::FILL_SOLID,
      'startColor' => [
         'rgb' => 'FFFFFF'
      ]
   ]
];


//odd row
$oddRow = [
   'fill' => [
      'fillType' => Fill::FILL_SOLID,
      'startColor' => [
         'rgb' => 'CCCCCC'
      ]
   ]
];


// heading 
$spreadsheet->getActiveSheet()
            ->setCellValue('A1', 'Danh sách học sinh');

// merge heading
$spreadsheet->getActiveSheet()->mergeCells("A1:F1");
$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);


// set column with
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(6);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);

//header Text
$spreadsheet->getActiveSheet()
            ->setCellValue('A2', 'ID')
            ->setCellValue('B2', 'Họ tên')
            ->setCellValue('C2', 'Giới tính')
            ->setCellValue('D2', 'Địa chỉ')
            ->setCellValue('E2', 'Ngày sinh')
            ->setCellValue('F2', 'SDT');

// background color
$spreadsheet->getActiveSheet()->getStyle('A2:F2')->applyFromArray($tableHead);

//
$spreadsheet->getActiveSheet()
            ->getStyle('E')
            ->getNumberFormat()
            ->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD);

$spreadsheet->getActiveSheet()
            ->getStyle('F')
            ->getNumberFormat()
            ->setFormatCode(NumberFormat::FORMAT_NUMBER);

// Content
$date = time();

$row = 3;
foreach($studentFinal as $student) {
      $spreadsheet->getActiveSheet()->setCellValue('A'.$row, $student['id']);
      $spreadsheet->getActiveSheet()->setCellValue('B'.$row, $student['fullname']);
      $spreadsheet->getActiveSheet()->setCellValue('C'.$row, $student['sex']);
      $spreadsheet->getActiveSheet()->setCellValue('D'.$row, $student['address']);
      $spreadsheet->getActiveSheet()->setCellValue('E'.$row, Date::PHPToExcel($date));     
      $spreadsheet->getActiveSheet()->setCellValue('F'.$row, $student['SDT']);        

               // set row style
             if($row % 2 == 0) {
                  $spreadsheet->getActiveSheet()->getStyle('A'.$row.':F'.$row)->applyFromArray($evenRow);
             }else {
                  $spreadsheet->getActiveSheet()->getStyle('A'.$row.':F'.$row)->applyFromArray($oddRow);
             }

             $row++;
}

// set the autofilter
$firstRow = 2;
$lastRow = $row-1;
$spreadsheet->getActiveSheet()->setAutoFilter("A".$firstRow.":F".$lastRow);


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="result.xlsx"');

// $writer = IOFactory::createWriter($spreadsheet, 'Xlsx'); 
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

