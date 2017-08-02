<div  class="block">
<h4>{l s='Welcome to this blog!' mod='blogmodule'}</h4>

<h3>Liste des articles</h3>
    {foreach from=$posts item=post}
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="{$post.link}">{$post.author}</a>
            </div>
        </div>
    {/foreach}
</div>
