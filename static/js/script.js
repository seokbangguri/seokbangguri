$(document).ready(function () {

  $('.hamburger').click(function(e) {
    if(obj.hambergur == false) {
      $('.bacon').addClass('active');
      $('.blur').addClass('active');
      obj.hambergur = true;
    }
    else {
      $('.bacon').removeClass('active');
      $('.blur').removeClass('active');
      obj.hambergur = false;
    }
  });

  $('.blur').on('click', function() {
    $('.bacon').removeClass('active');
    $('.blur').removeClass('active');
    obj.hambergur = false;
  });
  
  $('.ketchup li a').on('click', function() {
    $('.bacon').removeClass('active');
    $('.blur').removeClass('active');
    obj.hambergur = false;
  })


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
  $('#nav ul li a, #main a, .ketchup li a').on('click', function (event) {
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
      var sectionOffset = section.offset().top;
      var sectionHeight = section.height();
      var subtitle = section.find("#subtitle");
  
      if (scrollPos >= sectionOffset - sectionHeight && scrollPos <= sectionOffset + sectionHeight) {
        subtitle.addClass('active');
      }
      console.log(scrollPos);
      console.log(sectionOffset + sectionHeight);

    });
  });

  
  var sections = $('section:not(#blank)');
  var currentSection = 0;
  var isScrolling = false;

  $(window).on('scroll', function () {
    if (isScrolling) return;

    var windowHeight = $(window).height();
    var sectionBottom = sections.eq(currentSection).offset().top + sections.eq(currentSection).outerHeight();
    var windowBottom = $(window).scrollTop() + windowHeight;

    if (windowBottom >= sectionBottom) {
      isScrolling = true;

      if (currentSection < sections.length - 1) {
        currentSection++;
        $('html, body').stop().animate({
        scrollTop: sections.eq(currentSection).offset().top -80
      }, 800, function () {
        isScrolling = false;
      });
      }
    }
  });

  
  // 마우스 포인터 효과를 생성하는 스크립트
  $(document).on('mousemove', function(event) {
    var x = event.clientX;
    var y = event.clientY;

    $('.pointer-effect').css({
      top: y + 'px',
      left: x + 'px'
    });
  });
  // a,button 태그에 마우스 포인터 이미지 변경
  $('a,button').hover(function() {
    $('.pointer-effect-inner').css('background-color', '#e1e1e1');
  }, function() {
    $('.pointer-effect-inner').css('background-color', 'rgba(0, 0, 0, 0.700)');
  });

  $('footer').on('click', function(){
    console.log('gang');
    window.location.href = './static/pages/login.html';
  })

});
