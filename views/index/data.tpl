<tbody data-total="{$total}" class="wulaui">
{foreach $items as $row}
    <tr class="tr" data-type="{$row.type}" data-url="{$row.url|media}" data-width="{$row.width}" data-height="{$row.height}"
        data-size="{$row.size}">
        <td>
            <input type="checkbox" value="{$row.id}" class="grp"/>
        </td>
        <td>{$row.id}</td>
        <td>
            {if $row.type=='image'}
               <i class="fa fa-picture-o"></i>
            {elseif $row.type=='mp3'}
                <i class="fa fa-music"></i>
            {elseif $row.type=='viedo'}
                <i class="fa fa-video-camera"></i>
            {else}
                <i class="fa fa-file"></i>
            {/if}
        </td>
        <td>{$row.filename}</td>
        <td>{$row.size/1000}k</td>
        <td>{$row.create_time|date_format:'Y-m-d H:i:s'}</td>
    </tr>
    {foreachelse}
    <tr>
        <td colspan="6" class="text-center">暂无数据</td>
    </tr>
{/foreach}
</tbody>