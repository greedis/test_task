<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <title></title>
</head>
<body>
<h1>COUNTER</h1>
<div class="counters">
    <div class="counter">
        <p class="negativePosts">0</p>
        <p>Negative posts</p>
    </div>
    <div class="counter">
        <p class="allPosts">--</p>
        <p>All posts</p>
    </div>
    <div class="counter">
        <p class="positivePosts">0</p>
        <p>Positive posts</p>
    </div>
</div>
<h1>POSTS</h1>
<button type="button" class="btn btn-primary postForm" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add post
</button>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPost">
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Your name</label>
                        <input type="text" class="form-control" id="exampleInputName" name="visitor_name" REQUIRED>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Post</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="post"
                                  REQUIRED></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary addPost">Add post</button>
                    <p class="msg none"></p>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade comment" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title comment-title" id="exampleModalLabel">Write comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="addComment">
                    <div class="postId"></div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Your name</label>
                        <input type="text" class="form-control" id="exampleInputName" name="visitor_name" REQUIRED>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"
                                  REQUIRED></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add comment</button>
                    <p class="msg none"></p>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="posts">

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
<script src="/js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $.getJSON('/posts', function (data) {
            data = data['posts'];
            let len = data.length;
            let list_div = ' ';
            for (let i = 0; i < len; i++) {
                list_div += `<div class="feed-post" id="feed-post">`;
                list_div += `<div class="data-author"><h6>${data[i]['visitor_name']}</h6>
                            <small>${data[i]['created_at']}</small></div>`;

                list_div += `<div class="feed-description"><p>${data[i]['post']}</p></div>`;
                list_div += ``;
                list_div += `<div class="addCommentForm">
<div class="rating-result" id="result${data[i]['id']}" hidden>
	<span id="res-1${data[i]['id']}" class="active"></span>
	<span id="res-2${data[i]['id']}"></span>
	<span id="res-3${data[i]['id']}"></span>
	<span id="res-4${data[i]['id']}"></span>
	<span id="res-5${data[i]['id']}"></span>
</div>
<form class="rating" id="rating${data[i]['id']}">
<div class="rating-area">
<input name="id" value="${data[i]['id']}" hidden>
<input type="radio" id="star-5${data[i]['id']}" name="rating" value="5">
	<label for="star-5${data[i]['id']}" title="Оценка «5»"></label>
<input type="radio" id="star-4${data[i]['id']}" name="rating" value="4">
	<label for="star-4${data[i]['id']}" title="Оценка «4»"></label>
<input type="radio" id="star-3${data[i]['id']}" name="rating" value="3">
	<label for="star-3${data[i]['id']}" title="Оценка «3»"></label>
<input type="radio" id="star-2${data[i]['id']}" name="rating" value="2">
	<label for="star-2${data[i]['id']}" title="Оценка «2»"></label>
<input type="radio" id="star-1${data[i]['id']}" name="rating" value="1">
	<label for="star-1${data[i]['id']}" title="Оценка «1»"></label>

</div>
</form>
<form class="showForm">
<input name="post_id" value="${data[i]['id']}" type="hidden">
<button type="submit" class="btn btn-primary showButton">Show comments</button>
</form>
<button type="button" class="btn btn-primary hideButton">Hide comments</button>
<form class="addForm">
<input name="id" value="${data[i]['id']}" type="hidden">
<button type="submit" class="btn btn-primary add" data-bs-toggle="modal" data-bs-target="#exampleModal2">Add comment</button>
</form></div>`;
                list_div += `</div>`;
                list_div += `<div class="post${data[i]['id']}">`;
                list_div += `</div>`;
            }
            $(".allPosts").text(len);
            $(".posts").html(`${list_div}`);
        });
    });
    $('.addPost').click(function (e) {
        e.preventDefault();
        let visitor_name = $('input[name="visitor_name"]').val(),
            post = $('textarea[name="post"]').val();
        let formData = new FormData();
        formData.append('visitor_name', visitor_name);
        formData.append('post', post);
        $.ajax({
            url: '/post/create',
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            success(data) {
                if (data['status']) {
                    data = data['posts'];
                    let len = data.length;
                    let list_div = ' ';
                    for (let i = 0; i < len; i++) {
                        list_div += `<div class="feed-article" id="feed-article">`;
                        list_div += `<div class="data-author"><h6>${data[i]['visitor_name']}</h6>
                            <small>${data[i]['created_at']}</small></div>`;
                        list_div += `<div class="feed-description"><p>${data[i]['post']}</p></div>`;
                        list_div += ``;
                        list_div += `<div class="addCommentForm">
<div class="rating-result" id="result${data[i]['id']}" hidden>
	<span id="res-1${data[i]['id']}" class="active"></span>
	<span id="res-2${data[i]['id']}"></span>
	<span id="res-3${data[i]['id']}"></span>
	<span id="res-4${data[i]['id']}"></span>
	<span id="res-5${data[i]['id']}"></span>
</div>
<form class="rating" id="rating${data[i]['id']}">
<div class="rating-area">
<input name="id" value="${data[i]['id']}" hidden>
	<input type="radio" id="star-5${data[i]['id']}" name="rating" value="5">
	<label for="star-5${data[i]['id']}" title="Оценка «5»"></label>
	<input type="radio" id="star-4${data[i]['id']}" name="rating" value="4">
	<label for="star-4${data[i]['id']}" title="Оценка «4»"></label>
	<input type="radio" id="star-3${data[i]['id']}" name="rating" value="3">
	<label for="star-3${data[i]['id']}" title="Оценка «3»"></label>
	<input type="radio" id="star-2${data[i]['id']}" name="rating" value="2">
	<label for="star-2${data[i]['id']}" title="Оценка «2»"></label>
	<input type="radio" id="star-1${data[i]['id']}" name="rating" value="1">
	<label for="star-1${data[i]['id']}" title="Оценка «1»"></label>
</div>
</form>
<form class="showForm">
<input name="post_id" value="${data[i]['id']}" type="hidden">
<button type="submit" class="btn btn-primary showButton">Show comments</button>
</form>
<button type="button" class="btn btn-primary hideButton">Hide comments</button>
<form class="addForm">
<input name="id" value="${data[i]['id']}" type="hidden">
<button type="submit" class="btn btn-primary add" data-bs-toggle="modal" data-bs-target="#exampleModal2">Add comment</button>
</form></div>`;
                        list_div += `</div>`;
                        list_div += `<div class="post${data[i]['id']}">`;
                        list_div += `</div>`;
                    }

                    $('.msg').empty();
                    $('#exampleModal').modal('hide');
                    let all = $(".allPosts").text();
                    all++;
                    $(".allPosts").text(all);
                    $(".posts").prepend(`${list_div}`);
                    $('#addPost')[0].reset();
                } else {
                    $('.msg').removeClass('none').text(data.message);
                }

            }
        });
    });

    $(document).on('submit', '.addForm', function (e) {
        e.preventDefault();
        let data = $(this).find("input[name='id']").val();
        $('.msg').empty();
        $('.postId').html(`<input name="post_id" value="${data}" readonly hidden ">`);
    });

    $(document).on('submit', '.addComment', function (e) {
        e.preventDefault();
        let visitor_name = $(this).find("input[name='visitor_name']").val();
        let comment = $(this).find("textarea[name='comment']").val();
        let post_id = $(this).find("input[name='post_id']").val();
        let formData = new FormData();
        formData.append('visitor_name', visitor_name);
        formData.append('comment', comment);
        formData.append('post_id', post_id);
        $.ajax({
            url: '/comment/create',
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            success(data) {
                if (data['status']) {
                    data = data['comments'];
                    post_id = data[0]['post_id'];
                    let len = data.length;
                    let comment_div = ' ';
                    for (let i = 0; i < len; i++) {
                        comment_div += `<div class="feed-comment" id="feed-comment">`;
                        comment_div += `<div class="data-author"><h6>${data[i]['visitor_name']}</h6>
                            <small>${data[i]['created_at']}</small></div>`;
                        comment_div += `<div class="feed-description"><p>${data[i]['comment']}</p></div>`;
                        comment_div += `</div>`;
                    }
                    $('.addComment')[0].reset();
                    $('.msg').empty();
                    $('#exampleModal2').modal('hide');
                    $('.post' + post_id).empty().html(`${comment_div}`);
                } else {
                    $('.msg').removeClass('none').text(data.message);
                }
                $(document).on('click', '.hideButton', function (e) {
                    e.preventDefault();
                    $('.post' + post_id).empty();
                });
            }
        });
    });
    $(document).on('submit', '.showForm', function (e) {
        e.preventDefault();
        let post_id = $(this).find("input[name='post_id']").val();
        let formData = new FormData();
        formData.append('post_id', post_id);
        $.ajax({
            url: '/comment/show',
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            success(data) {
                if (data['status']) {
                    data = data['comments'];
                    post_id = data[0]['post_id'];
                    let len = data.length;
                    let comment_div = ' ';
                    for (let i = 0; i < len; i++) {
                        comment_div += `<div class="feed-comment" id="feed-comment">`;
                        comment_div += `<div class="data-author"><h6>${data[i]['visitor_name']}</h6>
                            <small>${data[i]['created_at']}</small></div>`;
                        comment_div += `<div class="feed-description"><p>${data[i]['comment']}</p></div>`;
                        comment_div += `</div>`;
                    }
                    $('.post' + post_id).empty().html(`${comment_div}`);
                } else {
                    let comment_div = `<div class="warning">`
                    comment_div += `<h6>${data.message}</h6>`
                    comment_div += `</div>`
                    $('.post' + post_id).empty().html(`${comment_div}`);
                }
                $(document).on('click', '.hideButton', function (e) {
                    e.preventDefault();
                    $('.post' + post_id).empty();
                });
            }
        });
    });
    $(document).on('input', '.rating', function (e) {
        e.preventDefault();
        let id = $(this).find("input[name='id']").val();
        let rating = $(this).find("input[name='rating']:checked").val();
        $('#rating' + id).attr('hidden', 'hidden');
        $('#result' + id).removeAttr('hidden');
        for (let i=1; i <= rating; i++){
            $('#res-' + i + id).attr('class', 'active');
        }
        let neg = $('.negativePosts').text();
        let pos = $('.positivePosts').text();
        if (rating > 3){
            pos++;
        }
        if (rating < 3){
            neg++
        }
        $('.negativePosts').text(neg);
        $('.positivePosts').text(pos);
    });

</script>
</body>
<link rel="stylesheet" href="/css/postList.css">
</html>
