$(function(){
    // 追加ボタン押下時イベント
    $('button#addButton').on('click',function(){
        // 現在の回答欄の数を取得
        // length:要素の数を取得
        var answerCount = $('div.addAnswer').length

        $('div.addAnswer').each(function(i) {
            if( (i+1) === answerCount){
                // 最後の1inputだけコピーする。div包括すると倍のコピーになってしまう。
                var copyElement = $(this).clone(true);
                // 孫要素にあたるのでfindで探す。labelもinputも一つなのでfindでOK。
                copyElement.find('label').attr('for', 'correct-answers-' + (i+1) + '-answer');
                // コピーしたid番号(i)を1加算する=更新
                // 追加したinput内のテキストは''でクリアする
                copyElement.find('input').attr('name', 'correct_answers['+(i+1)+'][answer]').attr('id', 'correct-answers-'+(i+1)+'-answer').val('');
                // 追加したinputにエラーメッセージが含まれた場合、削除する
                copyElement.children('.error-message').remove();
                $(this).after(copyElement);
            }
        });
    });
});
