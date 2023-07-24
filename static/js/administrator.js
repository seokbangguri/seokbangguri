$(document).ready(function() {
    $('#login-btn').click(function() {
      var username = $('#username').val();
      var password = $('#password').val();
      
      // 간단한 로그인 검증 (이 부분은 실제로는 서버에서 처리해야 함)
      if (username === 'user123' && password === 'pass123') {
        alert('로그인 성공!');
        // 로그인 성공 시 다른 페이지로 이동하거나 원하는 작업 수행
      } else {
        alert('로그인 실패. 사용자명과 비밀번호를 확인하세요.');
      }
    });
});

function goback(url) {
    window.location.href = url;
};
  