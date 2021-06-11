(function () {
      tinymce.PluginManager.add('wdm_mce_button', function (editor, url) {
          editor.addButton('wdm_mce_button', {
              text: 'Agregar Foro',
              icon: false,
              onclick: function () {
                  editor.windowManager.open({
                      title: 'CARGA DE FORO',
                      body: [
                          {
                              type: 'textbox',
                              name: 'textboxName',
                              label: 'IDENTIFICADOR DEL FORO',
                              value: ''
      
                          }
      
      
                      ],
                      onsubmit: function (e) {
                          target = '';
                          if(e.data.blank === true) {
                              target += 'newtab="on"';
                          }
                          editor.insertContent('[bbp-single-forum id=' + e.data.textboxName + ']');
                        }
                     });
                 }
             });
         });
      })();


