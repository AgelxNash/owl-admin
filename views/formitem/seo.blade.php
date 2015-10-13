    <div class="form-group">
        <label for="seo_h1">Заголовок страницы H1</label>
        <input class="form-control" name="seo[h1]" type="text" id="seo_h1" value="{{ $value->get('h1') }}">
    </div>

    <div class="form-group">
        <label for="seo_title">Заголовок страницы (Title)</label>
        <input class="form-control" name="seo[title]" type="text" id="seo_title" value="{{ $value->get('title') }}">
    </div>

    <div class="form-group">
        <label for="seo_description">Описание страницы (Meta description)</label>
        <input class="form-control" name="seo[description]" type="text" id="seo_description" value="{{ $value->get('description') }}">
    </div>

    <div class="form-group  {{ $errors->has('seo.keywords') ? 'has-error' : '' }}">
        <label for="seo_keywords">Ключевые слова</label>
        <input class="form-control" name="seo[keywords]" type="text" id="seo_keywords" value="{{ $value->get('keywords') }}">
        @foreach ($errors->get('seo.keywords') as $error)
            <p class="help-block">{{ $error }}</p>
        @endforeach
    </div>

    <div class="form-group">
        <label for="seo_robots">Robots</label>
        <div>
            <select id="seo_robots" name="seo[robots]" class="form-control multiselect" size="2" data-select-type="single">
                @foreach ($options->get('robots') as $optionValue => $optionLabel)
                    <option value="{{ $optionValue }}" {!! ($value->get('robots') == $optionValue) ? 'selected="selected"' : '' !!}>{{ $optionLabel }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="seo_state">State</label>
        <div>
        @foreach ($options->get('state') as $optionValue => $optionLabel)
            <div class="radio" style="display:inline-block;margin-top:0">
                <label>
                    <input type="radio" name="seo[state]" value="{{ $optionValue }}" {!! ($value->get('state') == $optionValue) ? 'checked' : '' !!}/>
                    {{ $optionLabel }}
                </label>
            </div>
        @endforeach
        </div>
    </div>

    <div class="form-group">
        <label for="seo_priority">Приоритет страницы (для карты сайта)</label>
        <div>
            <select id="seo_priority" name="seo[priority]" class="form-control multiselect" size="2" data-select-type="single">
                @foreach ($options->get('priority') as $optionValue => $optionLabel)
                    <option value="{{ $optionValue }}" {!! (str_replace(".", ",", $value->get('priority')) == $optionValue) ? 'selected="selected"' : '' !!}>{{ $optionLabel }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="seo_frequency">Переодичность обновления страницы</label>
        <div>
            <select id="seo_frequency" name="seo[frequency]" class="form-control multiselect" size="2" data-select-type="single">
                @foreach ($options->get('frequency') as $optionValue => $optionLabel)
                    <option value="{{ $optionValue }}" {!! ($value->get('frequency') == $optionValue) ? 'selected="selected"' : '' !!}>{{ $optionLabel }}</option>
                @endforeach
            </select>
        </div>
    </div>