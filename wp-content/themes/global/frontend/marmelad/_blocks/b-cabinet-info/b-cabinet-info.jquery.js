$('.b-cabinet-info__modify').each(function () {
    var $this = $(this),
        userDate = $this.find('.b-cabinet-info__user-date'),
        editBtn = $this.find('.b-cabinet-info__editBtn');

        editBtn.on('click', function () {
            userDate.removeAttr('disabled').select();
        });

});

$('.b-cabinet-info__edit span')