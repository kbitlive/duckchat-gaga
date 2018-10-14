
<script id="tpl-backup-tip" type="text/html">
    <div class="zaly_site_upgrade">
        <div class="zaly_site_upgrade_title">备份站点目录及数据库</div>
        <div class="zaly_site_upgrade_tip">是否已备份站点目录及数据库，如已备份请点击“确认”，进入版本升级操作</div>
        <div class="zaly_site_upgrade_operation">
            <button class="zaly_site_backup_sure" data-local-value="upgradeNowTip">确认</button>
        </div>
    </div>
</script>




<script id="tpl-upgrade-init" type="text/html">
    <div class="upgrade_init_title textcenter">自动检测需要执行以下过程</div>
    <div class="upgrade_process textcenter">
        {{each versions  version index}}
            <div class="textcenter margin-right2">
                {{if nowLength == 0}}
                    <div><img id="v_{{index}}" class="upgrade_img {{index}}" version="{{index}}" src="../../public/img/upgrade/current.png"></div>
                {{else}}
                <div> <img id="v_{{index}}" class="upgrade_img {{index}}" version="{{index}}" src="../../public/img/upgrade/todo.png"></div>
                {{/if}}
                <span>{{version}}</span>
            </div>
            {{if nowLength < (length-1) }}
                <div>  <img id="v_line_{{index}}" class="upgrade_line_img margin-right2" src="../../public/img/upgrade/todo_line.png"></div>
            {{/if}}
            <input type="hidden" value="{{nowLength = (nowLength+1)}}">
        {{/each}}

    </div>
    <div class="upgrade_info">
        <textarea class="upgrade_info_msg" disabled></textarea>
    </div>
    <div class="textcenter margin-top3">
        <button class="upgrade_staring_btn">开始升级</button>
    </div>
</script>


<script id="tpl-upgrade-token" type="text/html">
    <div class="upgrade_title">升级前，请先备份站点目录及数据库</div>
    <div class="upgrade_token_div">
        <input class="upgrade_token" type="text" placeholder="输入升级口令">
    </div>
    <div class="upgrade_tip">升级口令保存在src/xxxx文件里，请去服务端查看</div>
    <div class="textcenter">
        <button class="upgrade_next_btn">下一步</button>
    </div>
</script>
