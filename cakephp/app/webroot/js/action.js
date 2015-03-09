$(function(){

	$("button").attr("disabled", false);	//Firefox用?リロード時ボタンロック解除
/*
	$("#tdLoop tr").each(function(i){		//#tdLoop tr td
		$(this).delay(300 * i).fadeIn(1000);
	});
*/
	$("table").fadeIn(1000);

	var oldId = "";
	var color, oldColor;
	var pushImageId;
	$("table img").click(function(){
		var pushId = "#" + $(this).attr("id");
		var pushClass = $(this).attr("class");

		pushImageId = pushId;
		$("table img").not(pushId).css("opacity", "0.4");
		color = $(pushId).css("border-color");
		$("#commentImage").attr('src', $(this).attr('src'));

		if(oldId == ""){						//イラストを選択する
			oldColor = color;
			$(pushId).css("border-color", "#555555");
			$("#comment").stop().animate({"bottom": "0px"}, 300);
			$("#display").stop().animate({"right": "0px"}, 300);
			$("#imageDisplay").stop().animate({"left": "0px"}, 300);
			oldId = "#" + $(this).attr("id");
		}else{
			if(oldId == pushId){					//コメント入力を閉じる
				$(oldId).css("border-color", oldColor);
				$("#comment").stop().animate({"bottom": "-221px"}, 300);
				$("#display").stop().animate({"right": "-221px"}, 300);
				$("#imageDisplay").stop().animate({"left": "-221px"}, 300);
				$("img").css("opacity", "1.0");
				oldId = "";
			}else{							//イラスト選択中に他のイラストを選ぶ
				$(pushId).css("border-color", "#555555");
				$(oldId).css("border-color", oldColor);
				$(pushId).css("opacity", "1.0");
				oldColor = color;
				oldId = pushId;
			}
		}

		var jsonList;
		$.ajax({
			type: "POST",
			url: "/cakephp/paints/selectImageComment",
			dataType: "json",
			data: {
				id: pushId.replace(/#image/g, '')
			}
		}).done(function(data){
			//通信成功時の処理
			var list = "";
			var length = Object.keys(data).length;
			jsonList = data;
			for(var loop = length - 1; loop >= 0; loop--){
				list = list + "<li>" + (JSON.stringify(jsonList[loop].comments)).replace(/"/g, '') + "</li>";
			}
			$("#mainList").html(list);
			//alert(JSON.stringify(list[0].comments, null, "   ") + "    " + length);
		}).fail(function(data){
			//通信失敗時の処理
			//alert("Error");
		});
/*
		$.ajax({
			type: "POST",
			url: "/cakephp/paints/selectImage",
			dataType: "json",
			data: {
				//id: pushId.replace(/#image/g, '')
				id: pushClass.replace(/image/g, '')
			}
		}).done(function(data){
			//通信成功時の処理
			var list = "";
			var length = Object.keys(data).length;
			jsonList = data;
			for(var loop = length - 1; loop >= 0; loop--){
				//list = list + '<img src=' + '"' + 'http://j12027.sangi01.net/cakephp/app/webroot/img/' + (JSON.stringify(jsonList[loop].illustname)).replace(/"/g, '') + '"' + ' />';
				list = list + '<img src=' + '"' + 'http://localhost/cakephp/app/webroot/img/' + (JSON.stringify(jsonList[loop].illustname)).replace(/"/g, '') + '"' + ' />';
			}
			$("#imageList").html(list);
			//alert(list);
		}).fail(function(data){
			//通信失敗時の処理
			//alert("Error");
		});*/

		$.ajax({
			type: "POST",
			url: "/cakephp/paints/selectImage",
			dataType: "json",
			data: {
				//id: pushId.replace(/#image/g, '')
				id: pushClass.replace(/image/g, '')
			}
		}).done(function(data){
			//通信成功時の処理
			var list = "";
			var original = '<img src="" alt="this"/>';
			var length = Object.keys(data).length;
			jsonList = data;
			for(var loop = length - 1; loop >= 0; loop--){
				if(loop == 0){
					//original = '<img src=' + '"' + 'http://localhost/cakephp/app/webroot/img/' + (JSON.stringify(jsonList[loop].illustname)).replace(/"/g, '') + '"' + ' />';
					original = '<img src=' + '"' + 'http://j12027.sangi01.net/cakephp/app/webroot/img/' + (JSON.stringify(jsonList[loop].illustname)).replace(/"/g, '') + '"' + ' />';
				}else{
					//list = list + '<img src=' + '"' + 'http://localhost/cakephp/app/webroot/img/' + (JSON.stringify(jsonList[loop].illustname)).replace(/"/g, '') + '"' + ' />';
					list = list + '<img src=' + '"' + 'http://j12027.sangi01.net/cakephp/app/webroot/img/' + (JSON.stringify(jsonList[loop].illustname)).replace(/"/g, '') + '"' + ' />';
				}
			}
			$("#originalImage").html(original);
			$("#imageList").html(list);
			//alert(list);
		}).fail(function(data){
			//通信失敗時の処理
			//alert("Error");
		});
	});

	$("#commentButton").click(function(){
		var id = pushImageId.replace(/#image/g, '');
		var comment = $("#inputComment").val();

		if(comment != ""){
			$.ajax({
				type: "POST",
				url: "/cakephp/paints/addComment",
				dataType: "json",
				data: {
					id: id,
					comments: comment
				}
			}).done(function(data){
				//通信成功時の処理
				//alert("Success code:" + data);
				var listTagComment = "<li>" + comment + "</li>";
				$(listTagComment).prependTo("#mainList");
			}).fail(function(data){
				//通信失敗時の処理
				alert("Error code:" + data);
				$("#inputComment").val("Error...");
			});
		}

		$("#inputComment").val("");
		return false;
	});

	var color1 = "#99dd99", color2 = "#337733", color3 = "#ccffcc", color4 = "#337733", n = 16;
	var visitedLiBackgroundColor = new setRGB("#ffbb22", color1, n);
	var visitedLiTextColor = new setRGB("#993300", color2, n);
	var hoverLiBackgroundColor = new setRGB("#ffff88", color3, n);
	var hoverLiTextColor = new setRGB("#aa6600", color4, n);
	$("td button").click(function(){
		var buttonId = "#" + $(this).attr("id");
		var id = buttonId.replace(/#button/g, '');
		var textId = "#text" + id;
		var goodFormId = "#" + id;
		var good = parseInt($(textId).text());

		$.ajax({
			type: "POST",
			url: "/cakephp/paints/good",
			dataType: "json",
			data: {
				id: id
			}
		}).done(function(data){
			//通信成功時の処理
			//alert("Success code:" + data);
		}).fail(function(data){
			//通信失敗時の処理
			alert("Error code:" + data);
		});

		color1 = visitedLiBackgroundColor.colorChange();
		color2 = visitedLiTextColor.colorChange();
		color3 = hoverLiBackgroundColor.colorChange();
		color4 = hoverLiTextColor.colorChange();
		$(textId).text(good + 1);
		$(buttonId).attr("disabled", true).stop().animate({"color": "#993300", "backgroundColor": "#ffbb22"}, 300);
		$(goodFormId).stop().animate({"borderBottomColor": "#ffbb22", "backgroundColor": "#ffff88"}, 300);
		$(textId).stop().animate({"color": "#aa6600"}, 300);
		$("#top li").stop().animate({"color": color2, "backgroundColor": color1, "borderTopColor": color4, "borderRightColor": color4, "borderBottomColor": color4, "borderLeftColor": color4}, 1000);
		$("#top li a").stop().animate({"color": color4}, 1000);

		return false;
	});

	$("td button").mouseover(function(){
		var buttonId = "#" + $(this).attr("id");
		var id = buttonId.replace(/#button/g, '');
		var textId = "#text" + id;
		var goodFormId = "#" + id;
		var borderColor = "#99dd99"

		$(buttonId).stop().animate({"color": "#115511", "backgroundColor": "#77bb77"}, 150);
		$(goodFormId).stop().animate({"borderBottomColor": "#77bb77"}, 150);
	}).mouseout(function(){
		var buttonId = "#" + $(this).attr("id");
		var id = buttonId.replace(/#button/g, '');
		var textId = "#text" + id;
		var goodFormId = "#" + id;
		var borderColor = "#eeeeee";

		$(buttonId).stop().animate({"color": "#337733", "backgroundColor": "#99dd99"}, 150);
		$(goodFormId).stop().animate({"borderBottomColor": "#99dd99"}, 150);
	});

	$("#top li a").mouseover(function(){
		$(this).stop().animate({"backgroundColor": color3}, 150);
	}).mouseout(function(){
		$(this).stop().animate({"backgroundColor": ""}, 150);
	});
});