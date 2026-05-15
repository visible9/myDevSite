import $ from 'jquery';

$(document).ready(function () {
  acfPopupButtonBlock();
});

function acfPopupButtonBlock() {
  $(document).on('click', '.popup-button__btn', function () {
    const id = $(this).data('popup-id');
    $('#' + id)
      .addClass('is-open')
      .attr('aria-hidden', 'false');
    $('body').css('overflow', 'hidden');
  });

  $(document).on(
    'click',
    '.popup-button__close, .popup-button__overlay',
    function (e) {
      if (
        $(e.target).hasClass('popup-button__close') ||
        $(e.target).hasClass('popup-button__overlay')
      ) {
        $(e.target)
          .closest('.popup-button__overlay')
          .removeClass('is-open')
          .attr('aria-hidden', 'true');
        $('body').css('overflow', '');
      }
    }
  );
}
