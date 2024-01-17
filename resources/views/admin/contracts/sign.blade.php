<!doctype html>
<html>

<head>
  <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
</head>

<body>
  <h1>Sign here please</h1>
  <canvas></canvas>
  <form method="POST"> @csrf
    <input type="hidden" name="signature" id="signature">
    <button type="submit">Submit</button>
  </form>
  <script>
    const canvas = document.querySelector("canvas");

    const signaturePad = new SignaturePad(canvas);
    document.querySelector('form').addEventListener('submit', function (e) {
      document.getElementById('signature').value = signaturePad.toDataURL();
    });
  </script>
</body>

</html>