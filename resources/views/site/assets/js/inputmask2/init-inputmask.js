$(function(){
    // MASK
    var cellMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    cellOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(cellMaskBehavior.apply({}, arguments), options);
        }
    };

    $('.mask-cell').mask(cellMaskBehavior, cellOptions);
    $('.mask-phone').mask('(00) 0000-0000', {clearIfNotMatch: true});
    $(".mask-date").mask('00/00/0000', {clearIfNotMatch: true});
    $(".mask-datetime").mask('00/00/0000 00:00', {clearIfNotMatch: true, placeholder: "00/00/0000 00:00"});
    $(".mask-month").mask('00/0000', {reverse: true, clearIfNotMatch: true});
    $(".mask-doc").mask('000.000.000-00', {reverse: true, clearIfNotMatch: true});
    $(".mask-cnpj").mask('00.000.000/0000-00', {reverse: true, clearIfNotMatch: true});
    $(".mask-zipcode").mask('00000-000', {reverse: true, clearIfNotMatch: true});
    $(".mask-money").mask('R$ 000.000.000.000.000,00', {reverse: true, placeholder: "R$ 0,00", clearIfNotMatch: false});

    // SEARCH ZIPCODE
    $('.zip_code_search').blur(function () {

        function emptyForm() {
            $(".street").val("");
            $(".district").val("");
            $(".city").val("");
            $(".state").val("");
        }

        var zip_code = $(this).val().replace(/\D/g, '');
        var validate_zip_code = /^[0-9]{8}$/;

        if (zip_code != "" && validate_zip_code.test(zip_code)) {

            $(".street").val("");
            $(".district").val("");
            $(".city").val("");
            $(".state").val("");

            $.getJSON("https://viacep.com.br/ws/" + zip_code + "/json/?callback=?", function (data) {

                if (!("erro" in data)) {
                    $(".street").val(data.logradouro);
                    $(".district").val(data.bairro);
                    $(".city").val(data.localidade);
                    $(".state").val(data.uf);
                } else {
                    emptyForm();
                    console.log("CEP não encontrado.");
                }
            });
        } else {
            emptyForm();
            console.log("Formato de CEP inválido.");
        }
    });
});