<div class="table-responsive">
    <table class="table">
      <!--
      <tr>
          <td style="vertical-align:middle;width:180px;"><label>Uploaded Image</label></td>
          <td class="center"><img src="{{getUploadedImageUrl('discount',$discount->image)->thumbUrl}}"/></td>
      </tr>
      -->
      <tr>
          <td style="vertical-align:middle;width:180px;"><label>Title</label></td>
          <td>{{$discount->title}}</td>
      </tr>
      <tr>
          <td style="vertical-align:middle;"><label>Type</label></td>
          <td>{{$discount->type}}</td>
      </tr>
      @if($discount->type == 'price')
      <tr>
          <td style="vertical-align:middle;"><label>Discount Price</label></td>
          <td>@currency($discount->price)</td>
      </tr>
      @elseif($discount->type == 'rate')
      <tr>
          <td style="vertical-align:middle;"><label>Discount Rate</label></td>
          <td>{{$discount->rate}}% Off</td>
      </tr>
      @endif
      <tr>
          <td style="vertical-align:middle;"><label>Date Created</label></td>
          <td>{{date('m/d/Y H:i:s',strtotime($discount->created_at))}}</td>
      </tr>
      <tr>
          <td style="vertical-align:middle;"><label>Last Modified</label></td>
          <td>{{date('m/d/Y H:i:s',strtotime($discount->updated_at))}}</td>
      </tr>
      @if($discount->description != '')
      <tr>
          <td style="vertical-align:middle;"><label>Description</label></td>
          <td>{{$discount->description}}</td>
      </tr>
      @endif
    </table>
</div>