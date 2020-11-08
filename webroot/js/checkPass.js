$(function(){
    $('#passButton').on('click', function(){
        // 空欄の場合、パスワード変更なし
        if ($('#password').val() !== ''){
            // 半角英数字チェック
            if ($('#password').val().match( /[^A-Za-z0-9\s.-]+/ )) {
                alert('パスワードは半角英数文字で入力してください');
                return false;
            }
            // 文字8字以上チェック
            if ($('#password').val().length < 8) {
                alert('パスワードは8字以上で入力してください');
                return false;
            }
            // 内容一致チェック
            if ($('#password').val() !== $('#password_confirm').val()) {
                alert('確認用のパスワードと一致しません');
                return false;
            }
        }
        $('#passForm').submit();
    });
});
