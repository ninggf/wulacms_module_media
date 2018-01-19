<tbody data-total="{$total}" class="wulaui">
{foreach $items as $row}
    <tr class="tr" data-url="{$row.url}" data-width="{$row.width}" data-height="{$row.height}" data-size="{$row.size}">
        <td>
            <input type="checkbox" value="{$row.id}" class="grp"/>
        </td>
        <td>{$row.id}</td>
        <td>
            {if $row.type=='image'}
                <a target="_blank" href="/{{$row.url}}"><i class="layui-icon" style="font-size: 18px;">&#xe60d;</i></a>
            {elseif $row.type=='mp3'}
                <i class="layui-icon" style="font-size: 18px;">&#xe6fc;</i>
            {elseif $row.type=='viedo'}
                <i class="layui-icon" style="font-size: 18px;">&#xe6ed;</i>
            {else}
                <i class="layui-icon" style="font-size: 18px;">&#xe7a0;</i>
            {/if}
        </td>
        <td>{$row.filename}</td>
        <td>{$row.size/1000}k</td>

        <td class="text-right">

        </td>
    </tr>
    {foreachelse}
    <tr>
        <td colspan="5" class="text-center">暂无数据</td>
    </tr>
{/foreach}
</tbody>