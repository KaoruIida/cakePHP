$(function(){
    $('#qaButton').on('click', function(){
        // 必須項目入力チェック
        if ($('#question').val() == '') {
            alert('問題は入力必須項目です');
            return false;
        }
        // 文字制限チェック
        if ($('#question').val().length > 500) {
            alert('問題は500字以内で入力してください');
            return false;
        }
        $('.answer').each(function() {
            // 必須項目入力チェック
            if ($(this).val() == '') {
                alert('答えは入力必須項目です');
                return false;
            }
            // 文字制限チェック
            if ($(this).val().length > 20) {
                alert('回答は20字以内で入力してください');
                return false;
            }
        });
        $('#qaForm').submit();
    });
});
