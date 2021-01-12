$(document).ready(function () {
	var base_url = baseurl();

	$(".select2jurusan").select2({
		placeholder: "Pilih Jurusan",
		ajax: {
			url: base_url + "/jurusan/get_json",
			type: "post",
			dataType: "json",
			delay: 100,
			data: function (params) {
				return {
					searchTerm: params.term, // search term
				};
			},
			processResults: function (response) {
				return {
					results: response,
				};
			},
			cache: true,
		},
	});

	$(".select2mahasiswa").select2({
		placeholder: "Pilih Mahasiswa",
		ajax: {
			url: base_url + "/mahasiswa/get_json",
			type: "post",
			dataType: "json",
			delay: 100,
			data: function (params) {
				return {
					searchTerm: params.term, // search term
				};
			},
			processResults: function (response) {
				return {
					results: response,
				};
			},
			cache: true,
		},
	});

	$(".select2matkul").select2({
		placeholder: "Pilih Mata Kuliah",
		ajax: {
			url: base_url + "/mata_kuliah/get_json",
			type: "post",
			dataType: "json",
			delay: 100,
			data: function (params) {
				return {
					searchTerm: params.term, // search term
				};
			},
			processResults: function (response) {
				return {
					results: response,
				};
			},
			cache: true,
		},
	});

	$(".select2matkulwhere").select2({
		placeholder: "Pilih Mata Kuliah",
		ajax: {
			url: base_url + "/mata_kuliah/get_json_where",
			type: "post",
			dataType: "json",
			delay: 100,
			data: function (params) {
				return {
					searchTerm: params.term,
					no_mahasiswa: $("#mahasiswa").val(),
					semester: $("#semester").val(),
				};
			},
			processResults: function (response) {
				return {
					results: response,
				};
			},
			cache: true,
		},
	});

	$(".select2mutu").select2();
	$(".select2semesterr").select2();
});
