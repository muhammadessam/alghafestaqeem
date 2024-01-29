<!doctype html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <title>@lang('admin.contracts.sign_contract')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    @vite(['resources/css/signature-pad.css'])
</head>

<body onselectstart="return false">
    <div id="info">
        <h2>يرجى التوقيع على العقد</h2>
        <h4>رقم العقد: {{ $contract->token }}</h4>
        <h4>بإسم: {{ $contract->representative_name }}</h4>
    </div>
    <form id="signature-form" method="POST"> @csrf
        <input type="hidden" name="signature" id="signature">
    </form>

    <div id="signature-pad" class="signature-pad" style="{{ $contract->signature ? 'display: flex; justify-content: center; align-items: center; font-size: 1rem;' : ''}}">
        @if($contract->signature)
        <h1>@lang('admin.contracts.contract_signed')</h1>
        @else
        <div class="signature-pad--body">
            <canvas style="border: 1px solid black"></canvas>
        </div>
        <div class="signature-pad--footer">
            <div class="description">@lang('admin.contracts.sign_above')</div>

            <div class="signature-pad--actions">
                <div class="column">
                    <button type="button" class="button clear" data-action="clear">@lang('admin.contracts.clear_btn')</button>
                </div>
                <div class="column">
                    <button type="button" class="button save" data-action="sign-and-download-contract">@lang('admin.contracts.submit_btn')</button>
                </div>
            </div>
        </div>
        @endif
    </div>

    @vite(['resources/js/signature_pad.umd.js', 'resources/js/sign.js'])
</body>

</html>
