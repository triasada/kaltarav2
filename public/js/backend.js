// photo
function readURL(input, previewContainer, previewDocument) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + previewContainer).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// disable input
(function($) {
    $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
        if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
            this.value = "";
        }
        });
    };
}(jQuery));

// tinymce
function initiateTinyMCE(selectorElement, editorId, route)
{
    var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
    var editor_id = editorId;
    tinymce.PluginManager.add('mediaembed', function(editor, url) {
        editor.ui.registry.addButton('mediaembed', {
            icon: 'embed-page',
            tooltip: "Social Media Embed",
            onAction: function() {
                editor.windowManager.open({
                    title: 'Social Media Embed',
                    body: {
                        type: 'panel',
                        items: [
                            {
                                type: 'textarea',
                                height: '300px',
                                name: 'mediaembed',
                                label: 'Social Media embed code',
                            }
                        ],
                    },
                    buttons: [
                            {
                                type: 'submit',
                                name: 'submitButton',
                                text: 'Embed',
                                disabled: false,
                                primary: true,
                                align: 'start',
                            }
                    ],
                    onSubmit: function(e) {
                        var data = e.getData();
                        var embedCode = data.mediaembed;
                        var script = embedCode.match(/<script.*<\/script>/)[0];
                        var scriptSrc = script.match(/".*\.js/)[0].split("\"")[1];
                        var sc = document.createElement("script");
                        sc.setAttribute("src", scriptSrc);
                        sc.setAttribute("type", "text/javascript");

                        var iframe = document.getElementById(editor_id + "_ifr");
                        var iframeHead = iframe.contentWindow.document.getElementsByTagName('head')[0];

                        tinyMCE.activeEditor.insertContent(data.mediaembed);
                        iframeHead.appendChild(sc);
                        e.close();
                    }
                });
            }
        });
    });

    tinymce.init({
        selector: selectorElement,
        plugins: 'print preview paste importcss searchreplace autolink directionality code visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
        menubar: 'file edit view insert sosmed format tools table help',
        menu: {
            sosmed: { title: 'Social Media', items: 'embed' }
        },
        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview restoredraft print | insertfile image mediaembed template link anchor codesample | ltr rtl',
        toolbar_sticky: true,
        image_advtab: true,
        images_upload_handler: function(blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', route);
            var token = '{{ csrf_token() }}';
            xhr.setRequestHeader("X-CSRF-Token", token);
            xhr.onload = function() {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('upload', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        },
        height: 500,
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        toolbar_mode: 'wrap',
        contextmenu: 'link image imagetools table',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        relative_urls : false,
        remove_script_host : false,
        document_base_url : '{{ env("APP_URL") }}',
        setup: function (editor) {
            var toggleState = false;

            editor.ui.registry.addMenuItem('embed', {
                text: 'Social Media Embed',
                onAction: function () {
                    editor.windowManager.open({
                        title: 'Social Media Embed',
                        body: {
                            type: 'panel',
                            items: [
                                {
                                    type: 'textarea',
                                    height: '300px',
                                    name: 'mediaembed',
                                    label: 'Media embed code',
                                }
                            ],
                        },
                        buttons: [
                                {
                                    type: 'submit',
                                    name: 'submitButton',
                                    text: 'Embed',
                                    disabled: false,
                                    primary: true,
                                    align: 'start',
                                }
                        ],
                        onSubmit: function(e) {
                            var data = e.getData();
                            var embedCode = data.mediaembed;
                            var script = embedCode.match(/<script.*<\/script>/)[0];
                            var scriptSrc = script.match(/".*\.js/)[0].split("\"")[1];
                            var sc = document.createElement("script");
                            sc.setAttribute("src", scriptSrc);
                            sc.setAttribute("type", "text/javascript");

                            var iframe = document.getElementById(editor_id + "_ifr");
                            var iframeHead = iframe.contentWindow.document.getElementsByTagName('head')[0];

                            tinyMCE.activeEditor.insertContent(data.mediaembed);
                            iframeHead.appendChild(sc);
                            e.close();
                        }
                    });
                }
            });
        }
    });
}