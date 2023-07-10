<?php
header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
require_once('./tcpdf/tcpdf.php');

$data = json_decode(file_get_contents('php://input'), true);

// Создайте новый PDF-документ
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

// Установите отступы страницы
$pdf->SetMargins(10, 10, 10);

// Добавьте новую страницу
$pdf->AddPage();

// Установите шрифт и размер шрифта
$pdf->SetFont('dejavusans', '', 12, '', true);

// Вывод данных корзины в PDF
$pdf->Write(10, 'Чек покупки:');
$pdf->Ln();

foreach ($data['items'] as $item) {
  $pdf->Write(8, 'Название: ' . $item['title']);
  $pdf->Ln();
  $pdf->Write(8, 'Количество: ' . $item['quantity']);
  $pdf->Ln();
  $pdf->Write(8, 'Цена: ' . $item['totalPrice']);
  $pdf->Ln();
  $pdf->Write(8, '---------------------------');
  $pdf->Ln();
}

$pdf->Write(10, 'Итого: ' . $data['totalPrice'] . ' руб.');
$pdf->Ln();

// Генерация PDF-файла
$pdf->Output('receipt.pdf', 'I');
?>
