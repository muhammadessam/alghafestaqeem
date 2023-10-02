<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
{{-- JS assets at the bottom --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
{{-- ...Some more scripts... --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<style>
    .dropify-wrapper .dropify-preview .dropify-render img {
        opacity: 0.7;
        max-width: 100% !important;
    }

</style>
<script>
    var uploadedDocumentMap = {}

    Dropzone.options.documentDropzone = {
        url: "{{ route('admin.media.store') }}",
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        acceptedFiles: 'image/*',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function(file, response) {
            $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        },
        removedfile: function(file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="document[]"][value="' + name + '"]').remove()
        },
        init: function() {
            @if (isset($item) && $item->getMedia('document'))
                var files =
                {!! json_encode($item->getMedia('document')) !!}
                for (var i in files) {
                var file = files[i]
                this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                }
            @endif
        }
    }

</script>
