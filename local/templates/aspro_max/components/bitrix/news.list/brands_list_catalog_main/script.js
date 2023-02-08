$(document).on('click', '.btn-more', function () {
    $('.brands-block-news').show();
    $(this).hide();
    $('.btn-more-back').show();
})

$(document).on('click', '.btn-more-back', function () {
    $('.block_none').hide();
    $(this).hide();
    $('.btn-more').show();
})