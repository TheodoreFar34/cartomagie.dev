$(function() {
    $(".site-container").fadeIn();
    $("section").fadeOut("1000");
    $('#header__icon').click(function(e){
        e.preventDefault();
        $('body').toggleClass('with--sidebar');
        $this = $(this);
        if($this.hasClass('is-opened')){
            $this.addClass('is-closed').removeClass('is-opened');
        }else{
            $this.removeClass('is-closed').addClass('is-opened');
        }
    })
});
