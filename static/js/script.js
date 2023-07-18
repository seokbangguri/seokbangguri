$(document).ready(function () {

  $('.hamburger').click(function(e) {
    e.stopPropagation(); // 이벤트 전파 차단
    var bacon = $('.bacon');
    if (bacon.hasClass('active')) {
      bacon.removeClass('active');
    } else {
      bacon.addClass('active');
    }
  });

  $(document).mouseup(function(e) {
  
    // 다른 부위를 클릭한 경우에만 'active' 클래스 제거
    if (!$('.bacon').is(e.target) && $('.bacon').has(e.target).length === 0) {
      $('.bacon').removeClass('active');
    }
  });
  
  // 클릭 이벤트 처리
  $("#clickButton").click(function (event) {
    event.preventDefault();
    alert("클릭 이벤트가 발생했습니다!");
  });

  // 모달 열기 이벤트 처리
  $("#openModalButton").click(function () {
    $("body").addClass("modal-open");
    $("#myModal").fadeIn();
  });

  // 모달 닫기 이벤트 처리
  $(".close").click(function () {
    $("body").removeClass("modal-open");
    $("#myModal").fadeOut();
  });


  // 네비게이션 메뉴 클릭 시 스크롤 이벤트 처리
  $('#nav ul li a, #title a, .ketchup li a').on('click', function (event) {
    event.preventDefault();

    var target = $(this.hash);
    if (target.length) {
      $('html, body').animate({
        scrollTop: target.offset().top - 80
      }, 800); // 스크롤 속도 조정 가능 (ms)
    }
  });

  $(window).scroll(function() {
    var scrollPos = $(window).scrollTop();
  
    $('section').each(function() {
      var section = $(this);
      var sectionId = section.attr("id");
      var sectionOffset = section.offset().top;
      var sectionHeight = section.height();
      var subtitle = section.find("#subtitle");
  
      if (scrollPos >= sectionOffset - sectionHeight && scrollPos <= sectionOffset + sectionHeight) {
        subtitle.addClass('active');
      }
    });
  });
});
