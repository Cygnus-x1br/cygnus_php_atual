$(function () {
  $('form').ready(function () {
    $('.valor').mask('000000000.00', { reverse: true });
    $('.cpf').mask('000.000.000-00');
    $('.cnpj').mask('00.000.000/0000-00');
    // $('.tel').mask('(00) 0?0000-0000');

    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11
          ? '(00) 00000-0000'
          : '(00) 0000-00009';
      },
      spOptions = {
        onKeyPress: function (val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
        },
      };

    $('.tel').mask(SPMaskBehavior, spOptions);
  });
});
