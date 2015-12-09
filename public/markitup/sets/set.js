var markItUpSettings = {
    resizeHandle: false,
    onShiftEnter:  	{keepDefault:false, replaceWith:'<br />\n'},
    onCtrlEnter:  	{keepDefault:false, openWith:'\n<p>', closeWith:'</p>'},
    onTab:    		{keepDefault:false, replaceWith:'    '},
    markupSet:  [
        {
            name : "Абзац",
            className : 'mitup-paragraph',
            key: 'P',
            openWith : '<p(!( class="[![Class]!]")!)>',
            closeWith : '</p>'
        }, {
            name : "Жирный",
            key : 'B',
            className : 'mitup-bold',
            openWith : '<strong>',
            closeWith : '</strong>'
        }, {
            name:'Курсив',
            key:'I',
            className : 'mitup-italic',
            openWith:'(!(<em>|!|<i>)!)', closeWith:'(!(</em>|!|</i>)!)'
        }, {
            name : "Зачеркнутый",
            className : 'mitup-stroke',
            openWith : '<s>',
            closeWith : '</s>'
        }, {
            name : "Подчеркнутый",
            className : 'mitup-underline',
            openWith : '<u>',
            closeWith : '</u>'
        }, {
            separator : '---------------'
        }, {
            name : "Картинка",
            key : 'I',
            className : 'mitup-image',
            call : 'markitupElfinder'
        }, {
            name : "Ссылка",
            key : 'L',
            className : 'mitup-link',
            openWith : '<a href="[![Ссылка:!:http://]!]"(!( title="[![Описание]!]")!)>',
            closeWith : '</a>',
            placeHolder : ''
        }, {
            name : "Файл",
            key : 'F',
            className : 'mitup-file',
            call : 'markitupElfinderFile'
        }, {
            separator : '---------------'
        }, {
            name : "H1",
            key : '1',
            className : 'mitup-h1',
            openWith : '<h1(!( class="[![Class]!]")!)>',
            closeWith : '</h1>',
            placeHolder : ''
        }, {
            name : "H2",
            key : '2',
            className : 'mitup-h2',
            openWith : '<h2(!( class="[![Class]!]")!)>',
            closeWith : '</h2>',
            placeHolder : ''
        }, {
            name : "H3",
            key : '3',
            className : 'mitup-h3',
            openWith : '<h3(!( class="[![Class]!]")!)>',
            closeWith : '</h3>',
            placeHolder : ''
        }, {
            name :"H4",
            key : '4',
            className : 'mitup-h4',
            openWith : '<h4(!( class="[![Class]!]")!)>',
            closeWith : '</h4>',
            placeHolder : ''
        }, {
            name : "H5",
            key : '5',
            className : 'mitup-h5',
            openWith : '<h5(!( class="[![Class]!]")!)>',
            closeWith : '</h5>',
            placeHolder : ''
        }, {
            name : "H6",
            key : '6',
            className : 'mitup-h6',
            openWith : '<h6(!( class="[![Class]!]")!)>',
            closeWith : '</h6>',
            placeHolder : ''
        }, {
            separator : '---------------'
        }, {
            name : "Цитата",
            className : 'mitup-quote',
            openWith : '<blockquote>',
            closeWith : '</blockquote>'
        }, {
            name : "Noindex",
            className : 'mitup-noindex',
            openWith : '<noindex>',
            closeWith : '</noindex>'
        }, {
            separator : '---------------'
        }, {
            name : "Код",
            className : 'mitup-code',
            openWith : '<code>',
            closeWith : '</code>'
        }, {
            name : "Перекодирование",
            className : "mitup-encodechars",
            replaceWith : function (markItUp) {
                var container = document.createElement('div');
                container.appendChild(document.createTextNode(markItUp.selection));
                return container.innerHTML;
            }
        }, {
            name : "Очистить текст",
            className : 'mitup-clean',
            replaceWith : function (h) {
                return h.selection.replace(/<(.*?)>/g, "")
            }
        }, {
            separator : '---------------'
        }, {
            name : "Создать таблицу",
            className : 'mitup-tablegenerator',
            placeholder : "",
            replaceWith : function (markItUp) {
                var cols = prompt(_('markitup.callback_createtable_cols')),
                    rows = prompt(_('markitup.callback_createtable_rows')),
                    html = "<table>\n";
                if (markItUp.altKey) {
                    html += " <tr>\n";
                    for (var c = 0; c < cols; c++) {
                        html += "! [![TH" + (c + 1) + " text:]!]\n";
                    }
                    html += " </tr>\n";
                }
                for (var r = 0; r < rows; r++) {
                    html += " <tr>\n";
                    for (var c = 0; c < cols; c++) {
                        html += "  <td>" + (markItUp.placeholder || "") + "</td>\n";
                    }
                    html += " </tr>\n";
                }
                html += "<table>\n";
                return html;
            }
        }, {
            name : "Таблица",
            openWith : '<table>',
            closeWith : '</table>',
            placeHolder : "<tr><(!(td|!|th)!)></(!(td|!|th)!)></tr>",
            className : 'mitup-table'
        }, {
            name : "Строка",
            openWith : '<tr>',
            closeWith : '</tr>',
            placeHolder : "<(!(td|!|th)!)></(!(td|!|th)!)>",
            className : 'mitup-table-col'
        }, {
            name : "Ячейка",
            openWith : '<(!(td|!|th)!)>',
            closeWith : '</(!(td|!|th)!)>',
            className : 'mitup-table-row'
        }, {
            separator : '---------------'
        }, {
            name : "Список маркерованный",
            className : 'mitup-ul',
            openWith:'    <li>', closeWith:'</li>', multiline:true, openBlockWith:'<ul>\n', closeBlockWith:'\n</ul>'
        }, {
            name : "Список нумерованный",
            className : 'mitup-ol',
            openWith:'    <li>', closeWith:'</li>', multiline:true, openBlockWith:'<ol>\n', closeBlockWith:'\n</ol>'
        }, {
            name : "Элемент списка",
            className : 'mitup-li',
            openWith : '<li>',
            closeWith : '</li>'
        }, {
            separator : '---------------'
        }, {
            name : "Стиль",
            openWith : '<style>\n',
            closeWith : '\n</style>',
            className : 'mitup-css'
        }, {
            name : "Класс",
            className : 'mitup-class',
            placeHolder : '',
            openWith : '.[![Class name]!] {\n',
            closeWith : '\n}'
        }, {
            name : "Выравнивание",
            className : 'mitup-alignments',
            dropMenu : [{
                name : "По левому краю",
                className : 'mitup-left',
                replaceWith : 'text-align:left;'
            }, {
                name : "По центру",
                className : 'mitup-center',
                replaceWith : 'text-align:center;'
            }, {
                name : "По правому краю",
                className : 'mitup-right',
                replaceWith : 'text-align:right;'
            }, {
                name : "По ширине",
                className : 'mitup-justify',
                replaceWith : 'text-align:justify;'
            }
            ]
        }, {
            name : "Отступы",
            className : 'mitup-padding',
            dropMenu : [{
                name : "Сверху",
                className : 'mitup-top',
                openWith : '(!(padding|!|margin)!)-top:',
                placeHolder : '5px',
                closeWith : ';'
            }, {
                name : "Слева",
                className : 'mitup-left',
                openWith : '(!(padding|!|margin)!)-left:',
                placeHolder : '5px',
                closeWith : ';'
            }, {
                name : "Справа",
                className : 'mitup-right',
                openWith : '(!(padding|!|margin)!)-right:',
                placeHolder : '5px',
                closeWith : ';'
            }, {
                name : "Снизу",
                className : 'mitup-bottom',
                openWith : '(!(padding|!|margin)!)-bottom:',
                placeHolder : '5px',
                closeWith : ';'
            }
            ]
        }, {
            separator : '---------------'
        },
        //{name:'Preview', className:'preview',  call:'preview'},
        {
            name : "Проверка орфографии",
            afterInsert : function (h) {
                speller.check([h.textarea]);
            },
            className : 'mitup-spelling'
        }, {
            name : "Настройки проверки орфографии",
            afterInsert : function (h) {
                speller.optionsDialog();
            },
            className : 'mitup-spellingoptions'
        },
        {separator:'---------------' },

        {
            name: 'Полный экран',
            className: 'mitup-fullScreen',
            key: "F",
            call: function(){
                if ($('.markItUp').hasClass('fullScreen')) {
                    $('.markItUp').removeClass('fullScreen');
                    $('#markItUp').css(
                        'height',
                        markItUpTextareaOGHeight + "px"
                    );
                }
                else {
                    markItUpTextareaOGHeight = $('#markItUp').innerHeight();
                    $('.markItUp').addClass('fullScreen');
                    $('.markItUp.fullScreen #markItUp').css(
                        'height',
                        ($('.markItUp.fullScreen').innerHeight() - 90) + "px"
                    );
                }
            }
        }
    ]
};