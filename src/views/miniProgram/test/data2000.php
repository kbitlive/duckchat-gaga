<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test2000</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script type="text/javascript" src="../../../public/js/jquery.min.js"></script>
    <script src="../../../public/js/zalyjsNative.js"></script>
    <script src="../../../public/js/template-web.js"></script>
    <style>
        body, html {
            font-size: 10.66px;
            width: 100%;
        }

        .slide_div {
            margin-top: 3rem;
            text-align: center;
        }

        .button-2000 {
            border-width: 0;
            width: 80%;
            height: 40px;
            background-color: #9ed99d;
        }

    </style>
</head>
<body>

<div class="slide_div">
    <button class="button-2000" onclick="addTest2000('add2000Friends')">Add 2000 Friends</button>
</div>


<div class="slide_div">
    <button class="button-2000" onclick="addTest2000('add2000Groups')">Add 2000 Groups</button>
</div>

<div class="slide_div" style="color: red;font-size: 14px;">以下操作请先设置站点默认群组</div>

<div class="slide_div">
    <button class="button-2000" onclick="addTest2000('add2000GroupMembers')">Add 2000 Group Members</button>
</div>

<div class="slide_div">
    <button class="button-2000" onclick="addTest2000('add2000GroupAdmins')">Add 2000 Group Admins</button>
</div>

<div class="slide_div">
    <button class="button-2000" onclick="addTest2000('add2000GroupSpeakers')">Add 2000 Group Speakers</button>
</div>

<div class="slide_div">
    <button class="button-2000" onclick="addTest2000('add2000FriendApply')">Add 2000 Friend Apply</button>
</div>


<div class="slide_div">
    <button class="button-2000" onclick="addTest2000('add2000ChatList')">Add 2000 Chat List</button>
</div>

<script type="text/javascript" src="../../public/jquery/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../../public/manage/native.js"></script>

<script type="text/javascript">

    function addTest2000(type) {

        var url = "index.php?action=miniProgram.test.data2000";

        var data = {
            'type': type,
        };

        zalyjsCommonAjaxPostJson(url, data, addResponse);

    }

    function addResponse(url, data, result) {

        alert(result);
    }

</script>

</body>
</html>