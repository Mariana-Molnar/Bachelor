(function($) {

    function selectItems(event) {
        let value = event.value || event.target.value || $(event.target).data('value');

        if (typeof(value) === 'object' && value.newValue) {
            value = value.newValue;
        }

        let $parent = $(event.target).closest('.calculator-block');

        let $slider_el = $parent.find('.range-slider');
        let $input_el = $parent.find('.range-slider-input');
        let $rating_el = $parent.find('.raiting-icons-block .raiting-icon');
        let $plz_el = $parent.find('.plz-input');
        let $compare_tariff_link = $('.compare-tariff-link');

        $slider_el.slider('setValue', value);
        $input_el.val(value);
        $rating_el.each(function() {
            if ($(this).data('value') <= value ) {
                $(this).addClass('selected');
            } else {
                $(this).removeClass('selected');
            }
        });

        if ($compare_tariff_link.length) {
            let href = 'https://www.verivox.de/stromvergleich/vergleich/#/?plz={{plz}}&persons=on&usage={{usage}}&bonus=OnlyCompliant&profile=H0&product=electricity&source=1&q=WzUsMCwxLDEsMSwxLDEsMiwyMCwwLDEsNzA0MzQ4LCIwIiwxLDI0MCwyNDAsMjUwMCwwLDAsMCw5OTksLTEsLTEsLTEsMCwwLCJUb3RhbENvc3RzIiwiQXNjZW5kaW5nIiwiTm9uZSIsNTg5NjAsLTFd&partnerid=1';
            let plz = $plz_el.val();
            let usage = value;

            $compare_tariff_link.attr('href',href.replace('{{plz}}',plz).replace('{{usage}}', usage));
        }
    }

    function checkPlz(event) {
        let value = event.target.value;
        let $parent = $(event.target).parent();
        let $error = $parent.find('.form-error');

        if ($error.length) $error.hide();

        let valid = true;
        let message = '';

        if (isNaN(value)) {
            message =  __('Bitte geben Sie eine gültige Postleitzahl ein.');
            valid = false;
        } else if (value.length === 0) {
            message =  __('Bitte geben Sie eine Postleitzahl ein.');
            valid = false;
        } else if (value.length < 5) {
            message =  __('Bitte geben Sie eine fünfstellige Postleitzahl ein.');
            valid = false;
        }

        if (!valid && $error.length) {
            $error.html(message).show()
        }

        let $compare_tariff_link = $('.compare-tariff-link');
        if ($compare_tariff_link.length) {
            let $usage_el = $(event.target).closest('.calculator-block').find('.range-slider-input');
            let href = 'https://www.verivox.de/stromvergleich/vergleich/#/?plz={{plz}}&persons=on&usage={{usage}}&bonus=OnlyCompliant&profile=H0&product=electricity&source=1&q=WzUsMCwxLDEsMSwxLDEsMiwyMCwwLDEsNzA0MzQ4LCIwIiwxLDI0MCwyNDAsMjUwMCwwLDAsMCw5OTksLTEsLTEsLTEsMCwwLCJUb3RhbENvc3RzIiwiQXNjZW5kaW5nIiwiTm9uZSIsNTg5NjAsLTFd&partnerid=1';
            let plz = value;
            let usage = 3000;
            if ($usage_el.length) {
                usage = $usage_el.val();
            }
            $compare_tariff_link.attr('href',href.replace('{{plz}}',plz).replace('{{usage}}', usage));
        }

        return valid;
    }

    $(document).ready(function() {

        let $calculator_block = $('.calculator-block');
        if ($calculator_block.length) {
            $calculator_block.each(function(){

                let $plz_el = $(this).find('.plz-input');
                let $slider_el = $(this).find('.range-slider');
                let $input_el = $(this).find('.range-slider-input');
                let $rating_el = $(this).find('.raiting-icons-block .raiting-icon');

                if ($slider_el.length) {
                    $slider_el.slider().on('slide', selectItems);
                    $slider_el.slider().on('change', selectItems);
                }

                if ($rating_el.length) {
                    if ($slider_el.length) {
                        let min = $slider_el.slider('getAttribute', 'min');
                        let max = $slider_el.slider('getAttribute', 'max');

                        let step_val = Math.round((max-min)/$rating_el.length);
                        let step = 0;
                        $rating_el.each(function() {
                            $(this).attr('data-value', min+step*step_val);
                            step++;
                        });
                        $rating_el.last().attr('data-value', max);
                    }

                    $rating_el.on('click', selectItems)
                }

                if ($input_el.length) {
                    $input_el.on('change', selectItems).change();
                }

                if ($plz_el.length) {
                    $plz_el.on('input', checkPlz);
                }


            });
        }

    });

})(jQuery);
