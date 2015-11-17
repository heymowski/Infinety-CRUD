{{-- Show the errors, if any --}}
@if ($errors->any())
    <div class="callout callout-danger">
        <h4>{{ trans('validation.please_fix') }}</h4>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="">


    @foreach ($crud['fields']['normal'] as $field)
    @if(is_array($field))
            <!-- load the view from the application if it exists, otherwise load the one in the package -->
    @if(view()->exists('crud::fields.'.$field['type']))
        @include('crud::fields.'.$field['type'], ['field' => $field])
    @else
        @include('crud::fields.'.$field['type'], ['field' => $field])
    @endif
    @endif
    @endforeach


    @if(isset($crud['fields']['translate']))

        <ul class="nav nav-tabs nav-tabs-simple">
            <?php $x = 0; ?>
            @foreach($crud["languages"] as $language)
                <li class="{{ ($x == 0) ? 'active' : '' }}">
                    <a data-toggle="tab" href="#tab_{{$language["iso"]}}">{{$language["language"]}}</a>
                </li>
                <?php $x++; ?>
            @endforeach

        </ul>
        <div class="tab-content">
            <?php $x = 0; ?>
            <form role="form">
                @foreach($crud["languages"] as $language)
                    <div class="tab-pane {{ ($x == 0) ? 'active' : '' }}" id="tab_{{$language["iso"]}}">
                        <?php $lng = $language["iso"]; ?>

                        @foreach ($crud['fields']['translate'][$lng] as $field)

                        @if(is_array($field))
                                <!-- load the view from the application if it exists, otherwise load the one in the package -->
                        @if(view()->exists('crud::fields.'.$field['type']))
                            @include('crud::fields.'.$field['type'], ['field' => $field])
                        @else
                            @include('crud::fields.'.$field['type'], ['field' => $field])
                        @endif
                        @endif
                        @endforeach
                    </div>
                    <?php $x++; ?>
                @endforeach
            </form>
        </div>
    @endif
</div>

{{-- For each form type, load its assets, if needed --}}
{{-- But only once per field type (no need to include the same css/js files multiple times on the same page) --}}
<?php
$loaded_form_types_css = array();
$loaded_form_types_js = array();

?>

@section('custom_css')
        <!-- FORM CONTENT CSS ASSETS -->
    @foreach ($crud['fields']["normal"] as $field)
        @if(!isset($loaded_form_types_css[$field['type']]) || $loaded_form_types_css[$field['type']]==false)
            @if (View::exists('crud::fields.assets.css.'.$field['type'], ['field' => $field]))
                @include('crud::fields.assets.css.'.$field['type'], ['field' => $field])
                    <?php $loaded_form_types_css[$field['type']] = true; ?>
            @elseif (View::exists('crud::fields.assets.css.'.$field['type'], ['field' => $field]))
                @include('crud::fields.assets.css.'.$field['type'], ['field' => $field])
            <?php $loaded_form_types_css[$field['type']] = true; ?>
            @endif
        @endif
    @endforeach

    @foreach($crud["languages"] as $language)
        <?php $lng = $language["iso"]; ?>
        @foreach ($crud['fields']["translate"][$lng] as $field )
            @if(!isset($loaded_form_types_css[$field['type']]) || $loaded_form_types_css[$field['type']]==false)
                @if (View::exists('crud::fields.assets.css.'.$field['type'], ['field' => $field]))
                    @include('crud::fields.assets.css.'.$field['type'], ['field' => $field])
                    <?php $loaded_form_types_css[$field['type']] = true; ?>
                @elseif (View::exists('crud::fields.assets.css.'.$field['type'], ['field' => $field]))
                     @include('crud::fields.assets.css.'.$field['type'], ['field' => $field])
                <?php $loaded_form_types_css[$field['type']] = true; ?>
                @endif
            @endif
        @endforeach
    @endforeach

@endsection

@section('custom_js')
        <!-- FORM CONTENT JAVSCRIPT ASSETS -->

@foreach ($crud['fields']["normal"] as $field )

    @if(!isset($loaded_form_types_js[$field['type']]) || $loaded_form_types_js[$field['type']]==false)

        @if (View::exists('crud::fields.assets.js.'.$field['type'], ['field' => $field]))
            @include('crud::fields.assets.js.'.$field['type'], ['field' => $field])
            <?php $loaded_form_types_js[$field['type']] = true; ?>
        @elseif (View::exists('crud::fields.assets.js.'.$field['type'], ['field' => $field]))

            @include('crud::fields.assets.js.'.$field['type'], ['field' => $field])
            <?php $loaded_form_types_js[$field['type']] = true; ?>
        @endif
    @endif
@endforeach

@foreach($crud["languages"] as $language)
    <?php $lng = $language["iso"]; ?>
    @foreach ($crud['fields']["translate"][$lng] as $field )
        @if(is_array($field))
            @if(!isset($loaded_form_types_js[$field['type']]) || $loaded_form_types_js[$field['type']]==false)
                @if (View::exists('crud::fields.assets.js.'.$field['type'], ['field' => $field]))
                    @include('crud::fields.assets.js.'.$field['type'], ['field' => $field])
                    <?php $loaded_form_types_js[$field['type']] = true; ?>
                @elseif (View::exists('crud::fields.assets.js.'.$field['type'], ['field' => $field]))

                    @include('crud::fields.assets.js.'.$field['type'], ['field' => $field])
                    <?php $loaded_form_types_js[$field['type']] = true; ?>
                @endif
            @endif
        @endif
    @endforeach
@endforeach
@if(isset($crud['fields']['translate']))
    <script type="application/javascript">
                @foreach($crud["languages"] as $language)
                    var data = $("#tab_{{$language["iso"]}}");
        data.find(".form-group").each(function () {
            $(this).find("> *").each(function () {
                var inp = $(this).attr('name');
                if (inp) {
                    $(this).attr('name', "translate[{{$language["iso"]}}][" + inp + "]");
                }
            });

        });
        @endforeach
    </script>
@endif


@endsection