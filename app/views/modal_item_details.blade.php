<div class="table-responsive">
    <table class="table">
      <tr>
          <td style="vertical-align:middle;width:180px;"><label>Id</label></td>
          <td><strong>{{$item->id}}</strong></td>
      </tr>
      <tr>
          <td style="vertical-align:middle;width:180px;"><label>Name</label></td>
          <td>{{$item->name}}</td>
      </tr>
      <tr>
          <td style="vertical-align:middle;"><label>Price</label></td>
          <td>@currency($item->price)</td>
      </tr>
      <tr>
          <td style="vertical-align:middle;"><label>Brand</label></td>
          <td>{{$item->brand->name}}</td>
      </tr>
      <tr>
          <td style="vertical-align:middle;"><label>Main Category</label></td>
          <td>{{$item->main_category->name}}</td>
      </tr>
      <tr>
          <td style="vertical-align:middle;"><label>Sub Category</label></td>
          <td>{{$item->sub_category->name}}</td>
      </tr>
      <tr>
          <td style="vertical-align:top;"><label>Description</label></td>
          <td>{{$item->description}}</td>
      </tr>
      <tr>
          <td colspan="2" style="text-align:center;">
            <h4>Uploaded Images</h4>
            @foreach($item->images()->orderBy('is_primary','desc')->orderBy('updated_at','desc')->get() as $image)
            <img src="{{getUploadedImageUrl('item',$image->name)->mediumUrl}}"/>
            @endforeach
          </td>
      </tr>
    </table>
</div>