$(function(){
    $('#userButton').on('click', function(){
        // 必須項目入力チェック
        if ($('#name').val() == '') {
            alert('名前は入力必須項目です');
            return false;
        }
        // 半角英数字チェック
        if ($('#name').val().match( /[^A-Za-z0-9\s.-]+/ )) {
            alert('名前は半角英数文字で入力してください');
            return false;
        }
        // 必須項目入力チェック
        if ($('#password').val() == '') {
            alert('パスワードは入力必須項目です');
            return false;
        }
        // 半角英数字チェック
        if ($('#password').val().match( /[^A-Za-z0-9\s.-]+/ )) {
            alert('パスワードは半角英数文字で入力してください');
            return false;
        }
        // パスワード文字8字以上チェック
        if ($('#password').val().length < 8) {
            alert('パスワードは8字以上で入力してください');
            return false;
        }
        $('#userForm').submit();
    });
});
