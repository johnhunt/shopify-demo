{include file="header.tpl"}
{debug}
{if $messages.success.0}
    <div class="alert alert-success" role="alert">{$messages.success.0}</div>
{/if}
{if $messages.warn.0}
    <div class="alert alert-danger" role="alert">{$messages.warn.0}</div>
{/if}
{if $messages.validation.0}
    <div class="alert alert-danger" role="alert">{$messages.validation.0}</div>
{/if}
<div class="panel panel-default">
    <div class="panel-body">
        <h2>Add your product</h2>
        <!-- Please excuse the inline styles! -->
        <form method="post" action="/products" enctype="multipart/form-data" style="max-width: 50%">

            <div class="input-group">
                <input placeholder="Title" type="text" class="form-control" name="title" aria-label="Title">
            </div>


            <div class="input-group">
                <span class="input-group-addon">£</span>
                <input placeholder="Price" type="text" class="form-control" name="price" aria-label="Price">
            </div>


            <div class="input-group">
                <input placeholder="SKU" type="text" class="form-control" name="sku" aria-label="SKU">
            </div>


            <div class="input-group">
                <input placeholder="Vendor" type="text" class="form-control" name="vendor" aria-label="Vendor">
            </div>

            <div class="input-group">
                <input placeholder="Product type" type="text" class="form-control" name="productType"
                       aria-label="Product
                type">
            </div>


            <div class="input-group">
                Enter HTML description below (note, normally I'd check for XSS but limited on time!):
                <textarea placeholder="Body" class="form-control" name="body" aria-label="Body"></textarea>
            </div>

            <div class="dropzone dropzone-previews" id="my-dropzone"></div>

            <div class="form-group">
                <div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

    </div>
</div>
{include file="footer.tpl"}
