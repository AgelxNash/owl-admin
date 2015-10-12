<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#main">Общая информация</a></li>
    <li><a data-toggle="tab" href="#cpu">Информация о сервере</a></li>
    <li><a data-toggle="tab" href="#sql">MySQL </a></li>
</ul>

<div class="tab-content sysInfo">
    <!-- tab_Content -->
    <div id="main" class="tab-pane fade in active">
       <ul class="list-group">
           <li class="list-group-item">ВАШ IP: <span class="badge label-primary">{{ get_user_ip() }}</span></li>
           <li class="list-group-item">Максимальный размер загружаемых файлов: <span class="badge label-primary">{{ get_max_upload_size() }} МБайта</span></li>
           <li class="list-group-item">SafeMode: {!!  (ini_get('safe_mode') == 1) ? '<span class="badge label-success">Включен</span>' : '<span class="badge label-danger">Отключен</span>' !!}</li>
           <li class="list-group-item">Register Globals {!! (ini_get('register_globals') == 1) ? '<span class="badge label-success">Включен</span>' : '<span class="badge label-danger">Отключен</span>' !!}</li>
           <li class="list-group-item">Magic Quotes GPC {!! (ini_get('magic_quotes_gpc') == 1) ? '<span class="badge label-success">Включен</span>' : '<span class="badge label-danger">Отключен</span>' !!}</li>
           <li class="list-group-item">Zend Engine: <span class="badge label-primary">{{ (zend_version()) ? zend_version() : "Не доступен" }}</span></li>
           <li class="list-group-item">LARAVEL Version: <span class="badge label-primary">{{ \Illuminate\Foundation\Application::VERSION }}</span></li>
           <li class="list-group-item">Серверное время: <span class="badge label-primary">{{ Carbon\Carbon::now() }}</span></li>
           <li class="list-group-item">Версия php: <span class="badge label-primary">{{ implode(".", $ezc->phpVersion) }}</span>
               <div style="margin-bottom: 5px; text-align: right;" class="buttons">
                   <a class="btn btn-xs btn-warning" href="#" id="showphpinfo">Показать phpinfo()</a>
               </div>
           </li>
       </ul>
    </div> <!-- end tab_Content -->

    <!-- tab_Content -->
    <div id="cpu" class="tab-pane fade">
        <ul class="list-group">
            <li class="list-group-item">Процессор:  <span class="badge label-primary">{{ $ezc->cpuType }}</span></li>
            <li class="list-group-item">Доступно ядер:  <span class="badge label-primary">{{ $ezc->cpuCount }}</span></li>
            <li class="list-group-item">Частота:  <span class="badge label-primary">{{ $ezc->cpuSpeed }}</span></li>
            <li class="list-group-item">Доступно памяти:  <span class="badge label-primary">{{ format_bytes($ezc->memorySize) }}</span></li>
            <li class="list-group-item">Тип ОС:  <span class="badge label-primary">{{ $ezc->osType }}</span></li>
            <li class="list-group-item">Версия ОС:  <span class="badge label-primary">{{ $ezc->osName }}</span></li>
            <li class="list-group-item">Тип файловой системы:  <span class="badge label-primary">{{ $ezc->fileSystemType }}</span></li>
            <li class="list-group-item">Доступ к коммандной строке: {!! $ezc->isShellExecution ? '<span class="badge label-success">Есть</span>' : '<span class="badge label-danger">Отсутствует</span>' !!}</li>
        </ul>

    </div> <!-- end tab_Content -->

    <!-- tab_Content -->
    <div id="sql" class="tab-pane fade">
        <ul class="list-group">
            <li class="list-group-item">Имя базы данных: <span class="badge label-primary">{{ config('database.connections.mysql.database') }}</span></li>
            <li class="list-group-item">Кодировка базы данных: <span class="badge label-primary">{{ get_key(DB::select("show variables like 'character_set_database'"), 0)->Value }}</span></li>
            <li class="list-group-item">Сопоставление базы данных: <span class="badge label-primary">{{ get_key(DB::select("show variables like 'collation_database'"), 0)->Value }}</span></li>
            <li class="list-group-item">Префикс таблиц базы данных: <span class="badge label-primary">{{ config('database.connections.mysql.prefix') }}</span></li>
            <li class="list-group-item">Версия базы данных:<span class="badge label-primary"> {{ get_key(DB::select("show variables like '%innodb_version%'"), 0)->Value }}</span></li>
        </ul>

        <div class="box">
            <table class="table table-striped datatables">
                <thead>
                <th>Таблица</th>
                <th>Тип</th>
                <th>Сопоставление</th>
                <th>Записи</th>
                <th>Средний размер записи</th>
                <th>Объем данных</th>
                <th>Перерасход</th>
                <th>Размер индекса</th>
                <th>Общий объем</th>
                </thead>
                <tbody>
                @foreach($tableStatus as $table)
                    <tr>
                        <td>{{ $table->Name }}</td>
                        <td>{{ $table->Engine }}</td>
                        <td>{{ $table->Collation }}</td>
                        <td>{{ $table->Rows }}</td>
                        <td>{{ format_bytes($table->Avg_row_length) }}</td>
                        <td>{{ format_bytes($table->Data_length+$table->Data_free) }}</td>
                        <td>{{ format_bytes($table->Data_free) }}</td>
                        <td>{{ format_bytes($table->Index_length) }}</td>
                        <td>{{ format_bytes($table->Index_length + $table->Data_length + $table->Data_free) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- end tab_Content -->

</div>




<div id="phpInfoModal" class="modal fade">
    <div style="width:90%;" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">PHP Info</h4>
            </div>
            <div class="modal-body">
                <iframe id="frame" src="" style="zoom:0.60" width="99.6%" height="600px" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button id="phpinfoClose" type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        /**
         * Set Frame URL
         **/
        var frameSRC = "{{ route('admin.server', ['method' => 'phpinfo']) }}";
       /**
        * Set loader
        */
        var loader = '<div id="loader" class="dataTables_processing"><i class="fa fa-5x fa-circle-o-notch fa-spin"></i></div>';
        $('#showphpinfo').click(function(e){
            e.preventDefault();
            $('#phpInfoModal .modal-body').append(loader);
            $('#phpInfoModal').on('show.bs.modal', function () {
               $('iframe').attr("src",frameSRC);
            });
            $('#phpInfoModal').modal('show');
        });

         // Remove loader when frame is load
        $('#frame').load(function(){ $('#loader').remove(); });

        /**
         * Fix allready loaded iframe remove loader
         */
        $('#phpInfoModal').on('hidden.bs.modal', function () {
            // Fix: if loader wasn't remove after frame loaded
            if ($('#loader').length>0) {$('#loader').remove();}
            $('iframe').attr("src","");
        })

    });
</script>