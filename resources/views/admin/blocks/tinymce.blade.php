<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
<script>const useDarkMode = window.matchMedia("(prefers-color-scheme: dark)").matches,
        example_image_upload_handler = (e, a) => new Promise((o, t) => {
            let i = new XMLHttpRequest;
            i.withCredentials = !1, i.open("POST", "{{ url("/") }}/upload.php"), i.upload.onprogress = e => {
                a(e.loaded / e.total * 100)
            }, i.onload = () => {
                if (403 === i.status) {
                    t({message: "HTTP Error: " + i.status, remove: !0});
                    return
                }
                if (i.status < 200 || i.status >= 300) {
                    t("HTTP Error: " + i.status);
                    return
                }
                let e = JSON.parse(i.responseText);
                if (!e || "string" != typeof e.location) {
                    t("Invalid JSON: " + i.responseText);
                    return
                }
                o(e.location)
            }, i.onerror = () => {
                t("Image upload failed due to a XHR Transport error. Code: " + i.status)
            };
            let l = new FormData;
            l.append("file", e.blob(), e.filename()), i.send(l)
        });
    tinymce.init({
        selector: ".tinymce",
        branding: !1,
        promotion: !1,
        plugins: "preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media  table charmap nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion",
        editimage_cors_hosts: ["picsum.photos"],
        menubar: "file edit view insert format tools table help",
        toolbar: "insertfile a11ycheck undo redo | blocks  bold italic underline strikethrough blockquote emoticons |  forecolor backcolor  | alignleft aligncenter alignright alignjustify bullist numlist table | link image media fullscreen preview | code",
        toolbar_sticky: !1,
        language: "ru",
        image_advtab: !0,
        height: 450,
        statusbar: false,
        image_caption: !0,
        quickbars_selection_toolbar: "bold italic quicklink h2 h3 blockquote",
        noneditable_class: "mceNonEditable",
        images_upload_url: "{{ url("/") }}/upload.php",
        images_upload_handler: example_image_upload_handler,
        content_style: "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }"
    });</script>
