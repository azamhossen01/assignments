<!DOCTYPE html>
<html
  class="h-full bg-gray-100"
  lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0" />

    <!-- Tailwindcss CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AlpineJS CDN -->
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Inter Font -->
    <link
      rel="preconnect"
      href="https://fonts.googleapis.com" />
    <link
      rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet" />
    <style>
      * {
        font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont,
          'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans',
          'Helvetica Neue', sans-serif;
      }
    </style>

    <title>Transactions</title>
  </head>
  <body class="h-full">
    <div class="min-h-full">
      <div class="bg-sky-600 pb-32">
        <!-- Navigation -->
        
        <?php include(__DIR__ . "/../includes/admin_navbar.php") ?>

        <header class="py-10">
          <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">
              Transactions
            </h1>
          </div>
        </header>
      </div>

      <main class="-mt-32">
        <div class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
          <div class="bg-white rounded-lg py-8">
            <!-- List of All The Transactions -->
            <div class="px-4 sm:px-6 lg:px-8">
              <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                  <p class="mt-2 text-sm text-gray-700">
                    List of transactions made by the customers.
                  </p>
                </div>
              </div>
              <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div
                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                      <thead>
                        <tr>
                          <th
                            scope="col"
                            class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                            Receiver Name
                          </th>
                          <th
                            scope="col"
                            class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                            Email
                          </th>
                          <th
                            scope="col"
                            class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Amount
                          </th>
                          <th
                            scope="col"
                            class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Type
                          </th>
                          <th
                            scope="col"
                            class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Date
                          </th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200 bg-white">
                        <?php if(count($transactions) > 0){ ?>
                          <?php foreach($transactions as $transaction){ ?>
                            <tr>
                          <td
                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-800 sm:pl-0">
                            <?= $transaction['type'] === 'transfer' ? $transaction['transfer_to']['name'] : $transaction['user']['name']  ?>
                          </td>
                          <td
                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-0">
                            <?= $transaction['type'] === 'transfer' ? $transaction['transfer_to']['email'] : $transaction['user']['email']  ?>
                          </td>
                          <td
                            class="whitespace-nowrap px-2 py-4 text-sm font-medium <?= $transaction['in_out'] === 'in' ? 'text-emerald-600' : 'text-red-600' ?>">
                            <?= $transaction['in_out'] === 'in' ? '+' : '-' ?>$<?= number_format($transaction['amount']) ?>
                          </td>
                          <td
                            class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">
                            <?= ucfirst($transaction['type']) ?>
                          </td>
                          <td
                            class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">
                            <?= date_format(date_create($transaction['created_at']),"d M Y h:i A") ?>
                          </td>
                        </tr>

                          <?php } ?>
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
