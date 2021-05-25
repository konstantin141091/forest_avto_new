$(document).ready(function () {

  const stickyPhoto = new Sticky('.order-summary', {
    stickyFor:1200,
    marginTop:70
  });

  // МАСКА ДЛЯ ВВОДА ТЕЛЕФОНА  
  try{
    let phoneVal = '';
    if($('#phone').val() !== ''){
        phoneVal = $('#phone').val();
    }
    var cleave = new Cleave('#phone', {
      prefix: '+7',
      delimiters: [" (", ")", " ", "-", "-"],
      blocks: [2, 3, 0, 3, 2, 2],
      uppercase: true,
      noImmediatePrefix: true
    });
    
    if(phoneVal !== ''){
      $('#phone').val(phoneVal); 
    }

  } catch(e){}

  // ПСЕВДОПЛЭЙСХОЛДЕРЫ
  $('.field-group input').change(function(){
    if ($(this).val()!=='')
      $(this).addClass('not-empty');
  });

  $('label.placeholder').click(function(){
    $(this).siblings('input').focus();
  });

  // ПРОВЕРКА ТЕЛЕФОНА
  function isPhoneValid(val){
    const pattern = "^\\+7 \\(\\d{3}\\) \\d{3}-\\d{2}-\\d{2}$";
    const regex = new RegExp(pattern, "g");
    return regex.test(val);
  }

  $('.phone-field').change(function () {
    if(!isPhoneValid($(this).val())){
      $(this).siblings('.error-field').css('display', 'block');
      $(this).addClass('has-error');
    } else{
      $(this).siblings('.error-field').css('display', 'none');
      $(this).removeClass('has-error');
    }
  });

  // ПРОВЕРКА ИМЕНИ
  $('.name-field').change(function (){
    if($(this).val()==''){
      $(this).siblings('.error-field').css('display', 'block');
      $(this).addClass('has-error');
    } else{
      $(this).siblings('.error-field').css('display', 'none');
      $(this).removeClass('has-error');
    }
  });

  // ВАЛИДАЦИЯ ШАГ 1

  function isStep1Success(){
    const phone = $('.phone-field');
    const name = $('.name-field');
    if(name.val().length !== 0 && isPhoneValid(phone.val()) && !phone.hasClass('has-error')){
      $('#order-step-1').addClass('success');
    } else{
      $('#order-step-1').removeClass('success');
    }
  }

  $('#order-step-1 input').change(function () {
    isStep1Success();
  });

  // ВАЛИДАЦИЯ ШАГ 2

  // СВЯЗЬ РАДИО-КНОПОК ДОСТАВКИ И ОПЛАТЫ
  function setPayment(){
    const deliveryType = $('input[name="delivery"]:checked').attr('id');
    if (deliveryType=='delivery'){
        $('label[for="pay-1"]').css('display', 'block').closest('.field-group').addClass('curr-pay');
        $('label[for="pay-2"]').css('display', 'block').closest('.field-group').addClass('curr-pay');
        $('label[for="pay-4"]').css('display', 'none').closest('.field-group').removeClass('curr-pay');
        
    }
    else if (deliveryType=='by-myself'){
        $('label[for="pay-1"]').css('display', 'none').closest('.field-group').removeClass('curr-pay');
        $('label[for="pay-2"]').css('display', 'none').closest('.field-group').removeClass('curr-pay');
        $('label[for="pay-4"]').css('display', 'block').closest('.field-group').addClass('curr-pay');
    }
    $('input[name="payment"]').prop('checked', false);
  }

  function isAddrValid(){
    let hasDeliveryAddr = true;
    $('input.required-group').each(function () {
      if($(this).val() === ''){
        hasDeliveryAddr = false;
      }
    });

    return hasDeliveryAddr;
  }

  $('#order-step-2 .required-group').change(function () {
    if (!isAddrValid()){
        $('#order-step-2').removeClass('success');
        $('#order-step-2>.delivery-tab>.error-field').css('display', 'block');
        
      } else{
        $('#order-step-2').addClass('success');
        $('#order-step-2>.delivery-tab>.error-field').css('display', 'none');
      }
  });


  function isStep2Success(){
    $('#order-step-2').removeClass('success');

    const delivType = $('#order-step-2 .radio-group input:checked').attr('id');

    if (delivType=='delivery'){
      $('.delivery-tab').addClass('checked');
      $('.bymslf-tab').removeClass('checked');
      if (isAddrValid())
        $('#order-step-2').addClass('success');
    }
    else if (delivType=='by-myself'){
      $('.delivery-tab').removeClass('checked');
      $('.bymslf-tab').addClass('checked');
      $('#order-step-2').addClass('success');
    }
    $('input[name="pay-type"]:checked').prop('checked', false);

    setPayment();
  };

  $('#order-step-2 .radio-group input').change(function () {
    isStep2Success();
    isStep3Success();
  });

  isStep2Success();


  // ВАЛИДАЦИЯ ШАГ 3

  function isStep3Success(){
      if($('input[name=pay-type]:checked').length > 0){
          $('#order-step-3').addClass('success');
          // $('#order-step-3 .error-field').css('display', 'none');
      } else{
          $('#order-step-3').removeClass('success');
          // $('#order-step-3 .error-field').css('display', 'block');
      }
  }

  $('#order-step-3 input').change(function () {
    isStep3Success();
  });

  // ПРОВЕРКА ВСЕХ ШАГОВ

  function canBeProcessed(){
    if($('.order-step.success').length === $('.order-step').length){
      $('.order-summary .order-summary__btn').get(0).disabled = false;
    } else{
      $('.order-summary .order-summary__btn').get(0).disabled = true;
    }
  }

  $('.order-steps input').change(function () {
    canBeProcessed();
  });
  
});
