<?php
require_once('./tcpdf/tcpdf/tcpdf.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$data = json_decode(file_get_contents('php://input'), true);

// Создайте новый PDF-документ
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

// Установите отступы страницы
$pdf->SetMargins(10, 10, 10);

// Добавьте новую страницу
$pdf->AddPage();

// Установите шрифт и размер шрифта
$pdf->SetFont('helvetica', '', 12);

// Вывод данных корзины в PDF
$pdf->Write(10, 'Чек покупки:');
$pdf->Ln();

foreach ($data as $item) {
  $pdf->Write(8, 'Название: ' . $item['title']);
  $pdf->Ln();
  $pdf->Write(8, 'Количество: ' . $item['quantity']);
  $pdf->Ln();
  $pdf->Write(8, 'Цена: ' . $item['price']);
  $pdf->Ln();
  $pdf->Write(8, '---------------------------');
  $pdf->Ln();
}

// Генерация PDF-файла
$pdf->Output('receipt.pdf', 'I');
?>