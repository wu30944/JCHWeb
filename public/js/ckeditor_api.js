            // The instanceReady event is fired, when an instance of CKEditor has finished
            // its initialization.
            CKEDITOR.on('instanceReady', function(ev) {
                // Show the editor name and description in the browser status bar.
                // document.getElementById('eMessage').innerHTML = 'Instance <code>' + ev.editor.name + '<\/code> loaded.';

                // // Show this sample buttons.
                // document.getElementById('eButtons').style.display = 'block';

            });

            function InsertHTML($obj, $value) {
                // Get the editor instance that we want to interact with.
                // var editor = CKEDITOR.instances.editor1;
                // var value = document.getElementById('htmlArea').value;

                // Check the active editing mode.
                if ($obj.mode == 'wysiwyg') {
                    // Insert HTML code.
                    // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-insertHtml
                    $obj.insertHtml($value);
                } else
                    alert('You must be in WYSIWYG mode!');
            }

            /*
                20170915.  建立CKEDITOR物件
                如果在建立該物件時，有傳入視窗高度，則建立時使用使用者定義的大小，不然就是用預設高度
            */
            function CreateCKEDITOR($objID, $height = 0) {
                if ($height != 0) {
                    return CKEDITOR.replace($objID, {
                        skin: "kama",
                        height: $height,
                        on: {
                            focus: onFocus,
                            blur: onBlur,

                            // Check for availability of corresponding plugins.
                            pluginsLoaded: function(evt) {
                                var doc = CKEDITOR.document,
                                    ed = evt.editor;
                                if (!ed.getCommand('bold'))
                                    doc.getById('exec-bold').hide();
                                if (!ed.getCommand('link'))
                                    doc.getById('exec-link').hide();
                            }
                        }
                    });
                } else if ($height == 0) {
                    return CKEDITOR.replace($objID, {
                        on: {
                            focus: onFocus,
                            blur: onBlur,
                            // Check for availability of corresponding plugins.
                            pluginsLoaded: function(evt) {
                                var doc = CKEDITOR.document,
                                    ed = evt.editor;
                                if (!ed.getCommand('bold'))
                                    doc.getById('exec-bold').hide();
                                if (!ed.getCommand('link'))
                                    doc.getById('exec-link').hide();
                            }
                        }
                    });
                }

            }

            /*
                20170831. 增加請除編輯界面api
            */
            function ClearText($obj) {

                // Get the editor instance that we want to interact with.
                // var editor = CKEDITOR.instances.$id;
                // var value = document.getElementById('htmlArea').value;
                $obj.setData('');
            }

            function InsertText($obj, $value) {
                // Get the editor instance that we want to interact with.
                // var editor = CKEDITOR.instances.editor1;
                // var value = document.getElementById('txtArea').value;

                // Check the active editing mode.
                if ($obj.mode == 'wysiwyg') {
                    // Insert as plain text.
                    // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-insertText
                    $obj.insertText($value);
                } else
                    alert('You must be in WYSIWYG mode!');
            }

            function SetContents($obj, $value) {
                // Get the editor instance that we want to interact with.
                // var editor = CKEDITOR.instances.editor1;
                // var value = document.getElementById('htmlArea').value;

                // Set editor contents (replace current contents).
                // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-setData
                $obj.setData($value);
            }

            function GetContents($obj) {
                // Get the editor instance that you want to interact with.
                // var editor = CKEDITOR.instances.editor1;

                // Get editor contents
                // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getData
                // alert(editor.getData());
                return $obj.getData();
            }

            function ExecuteCommand($obj, commandName) {
                // Get the editor instance that we want to interact with.
                // var editor = CKEDITOR.instances.editor1;

                // Check the active editing mode.
                if ($obj.mode == 'wysiwyg') {
                    // Execute the command.
                    // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-execCommand
                    $obj.execCommand(commandName);
                } else
                    alert('You must be in WYSIWYG mode!');
            }

            function CheckDirty($obj) {
                // Get the editor instance that we want to interact with.
                // var editor = CKEDITOR.instances.editor1;
                // Checks whether the current editor contents present changes when compared
                // to the contents loaded into the editor at startup
                // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-checkDirty
                alert($obj.checkDirty());
            }

            function ResetDirty($obj) {
                // Get the editor instance that we want to interact with.
                // var editor = CKEDITOR.instances.editor1;
                // Resets the "dirty state" of the editor (see CheckDirty())
                // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-resetDirty
                $obj.resetDirty();
                alert('The "IsDirty" status has been reset');
            }

            function Focus($obj) {
                // CKEDITOR.instances.editor1.focus();
                $obj.focus();
            }

            function onFocus() {
                // document.getElementById('eMessage').innerHTML = '<b>' + this.name + ' is focused </b>';
            }

            function onBlur() {
                // document.getElementById('eMessage').innerHTML = this.name + ' lost focus';
            }

            function processData() {
                // getting data
                GetContents();
                alert($_POST['content']);
            }
