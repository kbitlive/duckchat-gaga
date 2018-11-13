

<script id="tpl-recommend-group" type="text/html">

    <div class="group_row"  groupId="{{groupId}}>
        <div class="group_info">
            <div class="group_detail_info">
                <div >
                    <img class="avatar" src="../../public/img/msg/default_user.png">
                </div>
                <div>
                    <div class="group_name">
                       {{groupName}}
                    </div>
                    <div class="group_owner">
                        群主：{{groupOwnerName}}
                    </div>
                </div>
            </div>
            <div class="add_group_button">
                <button class="join_group" groupId="{{groupId}}">一键加入</button>
            </div>
        </div>
    </div>
    <div class="line"></div>
</script>