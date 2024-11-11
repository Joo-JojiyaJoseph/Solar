<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-2xl p-6 m-10 bg-white rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-6 text-center">Lead Entry</h2>

        @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-black rounded">{{ session('success') }}
        </div>
        @endif
        @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
          <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

        <form action="{{ route('lead.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="text-center mb-6">
                <label class="block text-gray-600 font-semibold text-sm">Entry Date:</label>
                <input type="text" value="{{ now()->format('d-m-Y') }}"
                    class="text-center text-lg font-bold text-gray-800" readonly>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold">Lead Date</label>
                <input type="date" value="{{ now()->format('d-m-Y') }}"
                    class="text-center text-lg font-bold text-gray-800" name="lead_date">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold">Branch</label>
                <select name="branch"
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300 required">
                    <option value="">Select Branch*</option>
                    @foreach ($branchs as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold">Customer Full Name*</label>
                <input type="text" name="customer_name" required
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Customer Address*</label>
                <input type="text" name="customer_address" required
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Landmark</label>
                <input type="text" name="landmark"
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Contact Number*</label>
                <input type="tel" name="contact_number" required
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Alternate Number1</label>
                <input type="tel" name="alternate_number"
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Alternate Number2</label>
                <input type="tel" name="alternate_number1"
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Email ID</label>
                <input type="email" name="email"
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Service</label>
                <select name="service" id="service"
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
                    <option value="">Select Service</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>

{{--
            <div>
                <label class="block text-gray-700 font-semibold">Sub Service</label>
                <select name="sub_service" id="sub_service"
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
                    <option value="">Select Sub Service</option>
                </select>
            </div> --}}

            <script>
               document.addEventListener('DOMContentLoaded', function () {
    const serviceSelect = document.querySelector('select[name="service"]');
    const subServiceSelect = document.querySelector('select[name="sub_service"]');

    serviceSelect.addEventListener('change', function () {
        const serviceId = this.value;

        // Clear existing subservices
        subServiceSelect.innerHTML = '<option value="">Select Sub Service</option>';

        if (serviceId) {
            fetch(`/subservices/${serviceId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.length === 0) {
                        const noOption = document.createElement('option');
                        noOption.textContent = 'No subservices available';
                        subServiceSelect.appendChild(noOption);
                    } else {
                        data.forEach(subservice => {
                            const option = document.createElement('option');
                            option.value = subservice.id; // Adjust if needed based on your model fields
                            option.textContent = subservice.title; // Assuming 'name' is the field to display
                            subServiceSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => {
                    console.error('Fetch operation error:', error);
                });
        }
    });
});

            </script>


            <div>
                <label class="block text-gray-700 font-semibold">Comments</label>
                <textarea name="comments"
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300"></textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">referance</label>
                <input type="text" name="referance"
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
            </div>
            <div class="text-center">
                <button type="submit"
                    class="px-6 py-2 bg-green-500 text-white rounded-lg font-semibold transition duration-300 transform hover:scale-105">
                    Submit
                </button>
                <a href="{{ route('dashboard', '') }}"><button type="button"
                        class="px-6 py-2 bg-blue-500 text-white rounded-lg font-semibold transition duration-300 transform hover:scale-105">
                        Cancel
                    </button></a>
            </div>
        </form>
    </div>
    </div>
    </div>
</body>
</html>

