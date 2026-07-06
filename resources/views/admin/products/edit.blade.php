@extends('admin.layout')

@section('title', 'Editar Outfit')

@section('content')
<h1>Editar Outfit</h1>

<div class="tabs">
  <a class="btn" href="{{ route('admin.products.index') }}">Gestionar outfits</a>
  <a class="btn" href="{{ route('admin.products.create') }}">Nuevo outfit</a>
  <a class="btn" href="{{ route('admin.posts.index') }}">Gestionar posts</a>
</div>

<section class="panel">
  <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="form-grid">
    @csrf
    @method('PUT')
    <div>
      <label for="name">Nombre</label>
      <input id="name" name="name" value="{{ old('name', $product->name) }}" required>
    </div>
    <div>
      <label for="slug">Slug</label>
      <input id="slug" name="slug" value="{{ old('slug', $product->slug) }}">
    </div>
    <div class="field-full">
      <label for="description">Descripcion</label>
      <textarea id="description" name="description" required>{{ old('description', $product->description) }}</textarea>
    </div>
    <div>
      <label for="category_id">Categoria</label>
      <select id="category_id" name="category_id" required style="background: white;">
        <option value="">-- Seleccionar Categoría --</option>
        @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
    </div>
    <div>
      <label for="price">Precio Total</label>
      <input id="price" type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>
    </div>
    <div>
      <label for="stock">Stock</label>
      <input id="stock" type="number" name="stock" value="{{ old('stock', $product->stock) }}" required>
    </div>
    <div class="checkbox" style="margin-top: 24px;">
      <input id="is_active" type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
      <label for="is_active" style="margin:0;">Activo</label>
    </div>

    <div class="field-full" style="margin-top: 20px; border-top: 2px dashed #ecb8d2; padding-top: 20px;">
      <h2 style="font-family: 'Playfair Display'; font-style: italic; color: var(--hot-pink); margin-bottom: 5px;">✦ Sección 1: Imagen Principal del Outfit ✦</h2>
      <p style="font-size: 13px; color: #666; margin-bottom: 15px;">Sube la foto del outfit completo o indica una ruta preexistente.</p>
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
        <div>
          <label for="image">Subir Archivo de Imagen</label>
          <input id="image" type="file" name="image" accept="image/*">
          @if($product->image_path)
            <p style="margin-top: 5px; font-size: 12px; color: #888;">Actual: <code>{{ $product->image_path }}</code></p>
          @endif
        </div>
        <div>
          <label for="image_path">O escribir ruta manual</label>
          <input id="image_path" name="image_path" value="{{ old('image_path', $product->image_path) }}">
        </div>
      </div>
    </div>

    <div class="field-full" style="margin-top: 30px; border-top: 2px dashed #ecb8d2; padding-top: 20px;">
      <h2 style="font-family: 'Playfair Display'; font-style: italic; color: var(--hot-pink); margin-bottom: 5px;">✦ Sección 2: Prendas Individuales (Dressing Pieces) ✦</h2>
      <p style="font-size: 13px; color: #666; margin-bottom: 20px;">Sube las imágenes de las prendas y accesorios individuales de este outfit para el probador interactivo.</p>
      
      <div id="garments-list" style="display: flex; flex-direction: column; gap: 20px;">
      </div>
      
      <button type="button" class="btn" style="margin-top: 20px; border-color: var(--bubblegum); color: var(--bubblegum); background: white;" onclick="addGarmentRow()">
        💖 Agregar Nueva Prenda
      </button>
    </div>

    <div class="field-full" style="margin-top: 30px; border-top: 2px solid var(--soft-pink); padding-top: 20px;">
      <button class="btn primary" type="submit" style="width: 100%; padding: 15px; font-size: 16px;">Actualizar Outfit</button>
    </div>
  </form>

  @if($errors->any())
    <ul class="errors">
    @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
    </ul>
  @endif
</section>

<script>
let garmentCount = 0;

function addGarmentRow(existingData = null) {
  const container = document.getElementById('garments-list');
  const index = garmentCount++;
  
  const card = document.createElement('div');
  card.className = 'panel';
  card.style.cssText = 'position:relative; padding: 25px; border: 2px dashed #ffc2d4; border-radius: 20px; background: rgba(255, 255, 255, 0.6); display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 0;';
  card.id = `garment-row-${index}`;
  
  const title = existingData ? existingData.title : '';
  const desc = existingData ? existingData.desc : '';
  const price = existingData ? existingData.price : '';
  const styleVal = existingData ? existingData.style : '';
  const src = existingData ? existingData.src : '';
  
  card.innerHTML = `
    <button type="button" onclick="removeGarmentRow(${index})" style="position:absolute; top:12px; right:12px; border:none; background:none; color:#e53e3e; font-size:18px; cursor:pointer; font-weight:900;">✕</button>
    
    <div>
      <label style="color:var(--hot-pink);">Prenda #${index + 1}</label>
      <input name="garments[${index}][title]" value="${title}" placeholder="ej. Crop top acanalado" required>
    </div>
    
    <div>
      <label>Precio de la prenda</label>
      <input name="garments[${index}][price]" value="${price}" placeholder="ej. $45.00" required>
    </div>
    
    <div class="field-full">
      <label>Descripción de la prenda</label>
      <input name="garments[${index}][desc]" value="${desc}" placeholder="ej. Ribbed crop top in Wednesday pink style" required style="width:100%;">
    </div>
    
    <div>
      <label>Subir Imagen de Prenda</label>
      <input type="file" name="garments[${index}][image]" accept="image/*" ${existingData ? '' : 'required'}>
      ${src ? `<p style="margin-top:5px; font-size:11px; color:#888;">Actual: <code>${src}</code></p>` : ''}
      <input type="hidden" name="garments[${index}][existing_src]" value="${src}">
    </div>
    
    <div>
      <label>Tipo de Prenda (Preset de Posición Y2K)</label>
      <select onchange="updateStylePreset(${index}, this.value)" style="background: white;">
        <option value="">-- Personalizado --</option>
        <option value="top" ${styleVal.includes('top:100px') || styleVal.includes('top:110px') ? 'selected' : ''}>Torso / Tops</option>
        <option value="pants" ${styleVal.includes('top:330px') || styleVal.includes('top:310px') || styleVal.includes('top:315px') || styleVal.includes('top:300px') ? 'selected' : ''}>Piernas / Bottoms</option>
        <option value="shoes" ${styleVal.includes('top:490px') || styleVal.includes('top:480px') || styleVal.includes('top:485px') || styleVal.includes('top:460px') ? 'selected' : ''}>Pies / Zapatos</option>
        <option value="bag" ${styleVal.includes('top:250px') || styleVal.includes('top:220px') || styleVal.includes('top:200px') ? 'selected' : ''}>Accesorios / Bolso</option>
        <option value="necklace" ${styleVal.includes('top:45px') ? 'selected' : ''}>Cuello / Collar</option>
        <option value="jacket" ${styleVal.includes('top:40px') ? 'selected' : ''}>Abrigos / Camperas</option>
      </select>
    </div>
    
    <div class="field-full">
      <label>Estilo CSS de Posición (Fórmula de Maniquí)</label>
      <input id="garment-style-${index}" name="garments[${index}][style]" value="${styleVal || 'width:300px; top:100px; left:50%; transform:translateX(-50%);'}" required style="font-family:monospace; width:100%;">
    </div>
  `;
  container.appendChild(card);
}

function removeGarmentRow(index) {
  const row = document.getElementById(`garment-row-${index}`);
  if (row) {
    row.remove();
  }
}

const presets = {
  top: 'width:340px; top:100px; left:40.5%; transform:translateX(-50%);',
  pants: 'width:295px; top:330px; left:59.5%; transform:translateX(-50%);',
  shoes: 'width:210px; top:490px; left:15%; transform:rotate(-5deg);',
  bag: 'width:200px; top:250px; right:12%; transform:rotate(8deg);',
  necklace: 'width:130px; top:45px; left:48%; transform:translateX(-50%);',
  jacket: 'width:260px; top:40px; right:12%; transform:rotate(10deg);'
};

function updateStylePreset(index, value) {
  if (value && presets[value]) {
    document.getElementById(`garment-style-${index}`).value = presets[value];
  }
}

const existingGarments = {!! json_encode($product->garments ?? []) !!};
document.addEventListener('DOMContentLoaded', () => {
  if (existingGarments.length > 0) {
    existingGarments.forEach(garment => {
      addGarmentRow(garment);
    });
  } else {
    addGarmentRow();
  }
});
</script>
@endsection
