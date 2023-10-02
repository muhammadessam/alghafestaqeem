<script>
    $('#title_en-field').on('blur', function() {
        var theTitle = this.value.toLowerCase().trim(),
            slugInput = $('#slug-field'),
            theSlug = theTitle.replace(/&/g, '-and-')
            .replace(/[^a-z0-9-ءاآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگليمنةوهی]+/g, '-')
            .replace(/\-\-+/g, '-')
            .replace(/^-+|-+$/g, '');
        slugInput.val(theSlug);
    });

</script>
