<template id="sala-partida">
	<div>
		<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
			<div class="col-md-6 p-lg-5 my-5">
				<h1 class="display-3 fw-bold position-absolute top-5">
					{{ contrincante }}
					<span 
						class="position-absolute top-0 start-100 translate-middle p-2 border border-light rounded-circle"
						:class="[turno ? 'bg-danger' : 'bg-success']"
					>
						<span class="visually-hidden">New alerts</span>
					</span>
				</h1>
				<h3 class="fw-normal text-muted mb-3">{{ turno ? '¡Tu turno!' : 'Turno del rival' }}</h3>
			</div>
			<div
				@click.prevent ="tomarCartaMazo"
				@mouseover     ="mazoActivo=true"
				@mouseleave    ="mazoActivo=false"
				class          ="product-device shadow-sm d-none d-md-block"
				:class         ="[mazoActivo ? 'border border-primary' : '']"
			>		
			</div>
			<div
				v-if="jugado != null"
				class="product-device product-device-2 shadow-sm d-none d-md-block"
			>
				<div class="mt-5 p-3 text-black">
					<h2 class="display-5">{{ jugado.carta_nombre }}</h2>
					<p class="lead">{{ jugado.carta_desc }}</p>
				</div>
				<div class="bg-body shadow-sm mx-auto" style="height: 300px; border-radius: 21px 21px 0 0;"></div>
			</div>
		</div>
		<div class="d-flex justify-content-center d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
			<div 
				v-for          ="(i, k) in mano"
				@mouseover     ="cartaActiva=i.id"
				@mouseleave    ="cartaActiva=null"
				class          ="bg-body-tertiary me-md-3 pt-3 px-3 text-center overflow-hidden"
				:class         ="[cartaActiva==i.id ? 'border border-white' : 'border border-bottom-0']"
				@click.prevent ="lanzar(i.id)"
				>
				<div class="my-3 p-3">
					<h2 class="display-5">{{ i.carta_nombre }}</h2>
					<p class="lead">{{ i.carta_desc }}</p>
				</div>
				<div class="bg-body shadow-sm mx-auto" style="height: 300px; border-radius: 21px 21px 0 0;"></div>
			</div>
			<!-- <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden border border-bottom-0">
				<div class="my-3 p-3">
					<h2 class="display-5">TITULO</h2>
					<p class="lead">DESCRIPCION</p>
				</div>
				<div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
			</div>
			<div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden border border-bottom-0">
				<div class="my-3 p-3">
					<h2 class="display-5">TITULO</h2>
					<p class="lead">DESCRIPCION</p>
				</div>
				<div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
			</div>
			<div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden border border-bottom-0">
				<div class="my-3 p-3">
					<h2 class="display-5">TITULO</h2>
					<p class="lead">DESCRIPCION</p>
				</div>
				<div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
			</div>
			<div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden border border-bottom-0">
				<div class="my-3 p-3">
					<h2 class="display-5">TITULO</h2>
					<p class="lead">DESCRIPCION</p>
				</div>
				<div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
			</div>
			<div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden border border-bottom-0">
				<div class="my-3 p-3">
					<h2 class="display-5">TITULO</h2>
					<p class="lead">DESCRIPCION</p>
				</div>
				<div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
			</div>
			<div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden border border-bottom-0">
				<div class="my-3 p-3">
					<h2 class="display-5">TITULO</h2>
					<p class="lead">DESCRIPCION</p>
				</div>
				<div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
			</div>
			<div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden border border-bottom-0">
				<div class="my-3 p-3">
					<h2 class="display-5">TITULO</h2>
					<p class="lead">DESCRIPCION</p>
				</div>
				<div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
			</div>
			<div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden border border-bottom-0">
				<div class="my-3 p-3">
					<h2 class="display-5">TITULO</h2>
					<p class="lead">DESCRIPCION</p>
				</div>
				<div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
			</div>
			<div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden border border-bottom-0">
				<div class="my-3 p-3">
					<h2 class="display-5">TITULO</h2>
					<p class="lead">DESCRIPCION</p>
				</div>
				<div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
			</div>
			<div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden border border-bottom-0">
				<div class="my-3 p-3">
					<h2 class="display-5">TITULO</h2>
					<p class="lead">DESCRIPCION</p>
				</div>
				<div class="bg-body shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;"></div>
			</div> -->
		</div>
	</div>
</template>