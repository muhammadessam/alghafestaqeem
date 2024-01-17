<!doctype html>
<html lang="ar">

<head>
  <meta charset="utf-8">
  <title>@lang('admin.contracts.sign_contract')</title>
  <meta name="viewport"
    content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">

  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  @vite(['resources/css/signature-pad.css'])
</head>

<body onselectstart="return false">

  <form id="signature-form" method="POST"> @csrf
    <input type="hidden" name="signature" id="signature">
  </form>

  <div id="signature-pad" class="signature-pad">
    <div class="signature-pad--body">
      <canvas></canvas>
    </div>
    <div class="signature-pad--footer">
      <div class="description">@lang('admin.contracts.sign_above')</div>

      <div class="signature-pad--actions">
        <div class="column">
          <button type="button" class="button clear" data-action="clear">@lang('admin.contracts.clear_btn')</button>
        </div>
        <div class="column">
          <button type="button" class="button save"
            data-action="sign-and-download-contract">@lang('admin.contracts.submit_btn')</button>
        </div>
      </div>
    </div>
  </div>

  @vite(['resources/js/signature_pad.umd.js', 'resources/js/sign.js'])
</body>

</html>