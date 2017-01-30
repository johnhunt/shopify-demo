{include file="header.tpl"}
<div class="panel panel-default">
    <div class="panel-body">
        <h2>Add your product</h2>
        <!-- Please excuse the inline styles! -->
        <form method="post" action="/shop-demo/addProduct" enctype="multipart/form-data" class="dropzone"
              id="dropzone-upload" style="max-width: 50%">
            <div class="input-group">
                <span class="input-group-addon">£</span>
                <input type="text" class="form-control" aria-label="Amount">
            </div>

            <br />
            <div class="input-group">
                <button type="submit" class="btn btn-default btn-success">Submit</button>
            </div>
        </form>

    </div>
</div>
{include file="footer.tpl"}
