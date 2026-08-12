<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Visitor Feedback Report — Cagayan Museum</title>
    <style>
        @page {
            margin: 48px 40px 56px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            line-height: 1.45;
            color: #262626;
            margin: 0;
        }

        .report-document__header {
            display: table;
            width: 100%;
            border-bottom: 2px solid #262626;
            padding-bottom: 14px;
            margin-bottom: 20px;
        }

        .report-document__logo,
        .report-document__titles {
            display: table-cell;
            vertical-align: middle;
        }

        .report-document__logo {
            width: 72px;
        }

        .report-document__logo--right {
            text-align: right;
        }

        .report-document__logo img {
            width: 64px;
            height: 64px;
            object-fit: contain;
        }

        .report-document__titles {
            text-align: center;
            padding: 0 12px;
        }

        .report-document__museum {
            font-size: 16px;
            font-weight: bold;
            letter-spacing: 0.08em;
            margin: 0 0 4px;
            color: #111;
        }

        .report-document__report-title {
            margin: 0;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 0.04em;
            color: #333;
        }

        .report-document__report-subtitle {
            margin: 4px 0 0;
            font-size: 8px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #737373;
        }

        .report-document__meta {
            margin-bottom: 18px;
        }

        .report-document__section {
            margin-bottom: 18px;
            page-break-inside: avoid;
        }

        .report-document__section--break {
            page-break-before: auto;
        }

        .report-document__section-title {
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #262626;
            border-bottom: 1px solid #262626;
            padding-bottom: 4px;
            margin: 0 0 10px;
            text-align: left;
        }

        .report-document__fields {
            margin: 0;
            padding: 0;
        }

        .report-document__field {
            display: table;
            width: 100%;
            border-bottom: 1px solid #e5e5e5;
            padding: 5px 0;
        }

        .report-document__field:first-of-type {
            border-top: 1px solid #e5e5e5;
        }

        .report-document__field dt,
        .report-document__field dd {
            display: table-cell;
            margin: 0;
            vertical-align: top;
            padding: 0;
        }

        .report-document__field dt {
            width: 34%;
            font-size: 8px;
            font-weight: bold;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #525252;
        }

        .report-document__field dd {
            font-size: 10px;
            color: #111;
        }

        .report-document__data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .report-document__data-table thead tr {
            border-bottom: 2px solid #262626;
        }

        .report-document__data-table tbody tr {
            border-bottom: 1px solid #e5e5e5;
        }

        .report-document__data-table th,
        .report-document__data-table td {
            padding: 5px 4px;
            text-align: left;
            vertical-align: top;
            font-size: 9px;
            color: #111;
        }

        .report-document__data-table th {
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            font-size: 7px;
            color: #404040;
        }

        .report-document__col-no {
            width: 28px;
            text-align: center;
        }

        .report-document__feedback-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .report-document__feedback-item {
            padding: 8px 0;
            border-bottom: 1px solid #e5e5e5;
            page-break-inside: avoid;
        }

        .report-document__feedback-item:first-child {
            border-top: 1px solid #e5e5e5;
        }

        .report-document__feedback-meta {
            margin-bottom: 4px;
            font-size: 8px;
            color: #525252;
        }

        .report-document__feedback-no {
            font-weight: bold;
            color: #262626;
        }

        .report-document__feedback-date {
            font-weight: bold;
            color: #262626;
            margin-left: 6px;
        }

        .report-document__feedback-rating {
            float: right;
            font-size: 7px;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .report-document__feedback-text {
            margin: 0;
            padding-left: 14px;
            font-size: 9px;
            line-height: 1.5;
            color: #333;
            word-wrap: break-word;
        }

        .report-document__empty {
            color: #737373;
            font-style: italic;
            margin: 0;
            font-size: 9px;
        }

        .report-document__footer {
            border-top: 1px solid #262626;
            margin-top: 22px;
            padding-top: 10px;
            text-align: center;
            color: #525252;
            font-size: 8px;
        }

        .report-document__footer-line {
            font-weight: bold;
            color: #262626;
            margin: 0 0 2px;
        }

        .report-document__footer-meta {
            margin: 6px 0 0;
            line-height: 1.5;
        }
    </style>
    <script type="text/php">
        if (isset($pdf)) {
            $font = $fontMetrics->getFont('DejaVu Sans');
            $size = 8;
            $pageText = 'Page {PAGE_NUM} of {PAGE_COUNT}';
            $width = $fontMetrics->getTextWidth($pageText, $font, $size);
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 28;
            $pdf->page_text($x, $y, $pageText, $font, $size, [0.3, 0.3, 0.3]);
        }
    </script>
</head>
<body>
    @include('reports.partials.document', [
        'documentClass' => 'report-document--pdf',
        'logoBase64' => $logoBase64,
    ])
</body>
</html>
