$(document).on('click','.js-like', function(){

  //いいねされた日記のIDを取得
  // $(this):今回クリックされたiタグ
  //.siblings('XXX'):兄弟の要素を取得
  //val() : inputタグのvalueの値を取得
  let diaryId = $(this).siblings('.diary-id').val();

  //likeメソッドの実行
    like(diaryId, $(this));

});
//diaryId:いいねする日記のID
// ckickedBtn:今回クリックされたいいねのアイコン
function like(diaryId, clickedBtn) {
	$.ajax({
		url: 'diary/' + diaryId + '/like',
		type: 'POST',
		dataType:'json',

		headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	}).done((data) => {
		console.log(data);
		//いいねの数を増やす
		// 1. 現在のいいね数を習得
		//text() : <a>XXX</a> XXXの部分を習得
		let num = clickedBtn.siblings('.js-like-num').text();

		//numを数値に変換する
		num = Number(num);

		// 2. 1プラスした結果を設定する
		//text(YYY) : <a>XXX</a> XXXの部分をYYYに置き換える
		clickedBtn.siblings('.js-like-num').text(num + 1);

		//いいねのボタンのデザインを変更
		changeLikeBtn(clickedBtn);
	}).fail((error) => {
        console.log(error);
	});
}
//色を変えたいいいねアイコン
//メソッドチェーン
//js-like,js-dislikeの切り替え
function changeLikeBtn(btn){
	btn.toggleClass('far').toggleClass('fas');
	btn.toggleClass('js-like').toggleClass('js-dislike');
}

	//いいね解除の処理
$(document).on('click','.js-dislike', function() {
	let diaryId = $(this).siblings('.diary-id').val();

	//dislikeメソッドの実行
	dislike(diaryId,$(this));
});

function dislike(diaryId, clickedBtn) {
	$.ajax({
		url: 'diary/' + diaryId + '/dislike',
		type: 'POST',

		headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	}).done((data) => {
		console.log(data);
		//いいねの数を増やす
		// 1. 現在のいいね数を習得
		//text() : <a>XXX</a> XXXの部分を習得
		let num = clickedBtn.siblings('.js-like-num').text();

		//numを数値に変換する
		num = Number(num);

		// 2. 1マイナスした結果を設定する
		//text(YYY) : <a>XXX</a> XXXの部分をYYYに置き換える
		clickedBtn.siblings('.js-like-num').text(num - 1);

		//いいねのボタンのデザインを変更
		changeLikeBtn(clickedBtn);
	}).fail((error) => {
        console.log(error);
	});
}
