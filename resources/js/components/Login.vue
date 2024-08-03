<script setup>
</script>
<template>
  <div class="max-w-[1940px] mx-auto max-h-[1113px]">
    <div class="bg-white m-0 p-0 w-full flex">
      <div
        class="w-full bg-white xl:w-6/12 relative h-screen flex flex-col gap-3 items-center overflow-y-scroll"
      >
        <div
          class="reg-bottom-bar w-full sticky left-0 right-0 bottom-0 py-3 lg:px-10 mt-5 lg:mt-0"
        >
          <ul
            class="m-0 p-4 lg:p-0 flex flex-col lg:flex-row lg:gap-x-6 gap-y-3 lg:gap-y-0"
          >
            <li class="flex items-center space-x-2 cursor-pointer">
              <div class="botttom-tab active-bottom-tab">1</div>
              <div class="mr-4 text-xs lg:text-base">Company Account</div>
              <svg
                width="8"
                height="10"
                viewBox="0 0 8 14"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M1 13L7 7L1 1"
                  stroke="black"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                ></path>
              </svg>
            </li>
          </ul>
        </div>
        <div class="w-11/12 mx-auto flex flex-col my-4">
          <div class="w-full lg:w-8/12 xl:w-10/12 min-h-fit max-h-fit mx-auto">
            <div class="w-full lg:w-10/12 mx-auto">
              <div class="">
                <div class="flex items-center justify-between mt-10">
                  <h1
                    class="text-yaraa-100 m-0 p-0 mb-4 text-sm lg:text-xl font-bold"
                  >
                    Create your account
                  </h1>
                  <!-- <img
                    alt="help"
                    srcset=" 1x,  2x"
                    src=""
                    width="18"
                    height="18"
                    decoding="async"
                    data-nimg="1"
                    loading="lazy"
                    style="color: transparent"
                  /> -->
                </div>

                <form>
                  <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                      <label
                        for="first_name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >First name</label
                      >
                      <input
                        type="text"
                        id="first_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John"
                        required
                      />
                    </div>
                    <div>
                      <label
                        for="last_name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Last name</label
                      >
                      <input
                        type="text"
                        id="last_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Doe"
                        required
                      />
                    </div>
                  </div>
                  <div class="mb-6">
                    <label
                      for="email"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Email address</label
                    >
                    <input
                      type="email"
                      id="email"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="john.doe@company.com"
                      required
                    />
                  </div>
                  <div class="mb-6">
                    <label
                      for="email"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Business name</label
                    >
                    <input
                      type="email"
                      id="email"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="john.doe@company.com"
                      required
                    />
                  </div>
                  <div class="mb-6">
                    <label
                      for="email"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >RC number</label
                    >
                    <input
                      type="email"
                      id="email"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="john.doe@company.com"
                      required
                    />
                  </div>
                  <div class="mb-6">
                    <label
                      for="email"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >RC number</label
                    >
                    <div class="flex items-center">
                      <button
                        id="dropdown-phone-button"
                        data-dropdown-toggle="dropdown-phone"
                        class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
                        type="button"
                      >
                        <svg
                          fill="none"
                          aria-hidden="true"
                          class="h-4 w-4 me-2"
                          viewBox="0 0 20 15"
                        >
                          <rect
                            width="19.6"
                            height="14"
                            y=".5"
                            fill="#fff"
                            rx="2"
                          />
                          <mask
                            id="a"
                            style="mask-type: luminance"
                            width="20"
                            height="15"
                            x="0"
                            y="0"
                            maskUnits="userSpaceOnUse"
                          >
                            <rect
                              width="19.6"
                              height="14"
                              y=".5"
                              fill="#fff"
                              rx="2"
                            />
                          </mask>
                          <g mask="url(#a)">
                            <path
                              fill="#D02F44"
                              fill-rule="evenodd"
                              d="M19.6.5H0v.933h19.6V.5zm0 1.867H0V3.3h19.6v-.933zM0 4.233h19.6v.934H0v-.934zM19.6 6.1H0v.933h19.6V6.1zM0 7.967h19.6V8.9H0v-.933zm19.6 1.866H0v.934h19.6v-.934zM0 11.7h19.6v.933H0V11.7zm19.6 1.867H0v.933h19.6v-.933z"
                              clip-rule="evenodd"
                            />
                            <path fill="#46467F" d="M0 .5h8.4v6.533H0z" />
                            <g filter="url(#filter0_d_343_121520)">
                              <path
                                fill="url(#paint0_linear_343_121520)"
                                fill-rule="evenodd"
                                d="M1.867 1.9a.467.467 0 11-.934 0 .467.467 0 01.934 0zm1.866 0a.467.467 0 11-.933 0 .467.467 0 01.933 0zm1.4.467a.467.467 0 100-.934.467.467 0 000 .934zM7.467 1.9a.467.467 0 11-.934 0 .467.467 0 01.934 0zM2.333 3.3a.467.467 0 100-.933.467.467 0 000 .933zm2.334-.467a.467.467 0 11-.934 0 .467.467 0 01.934 0zm1.4.467a.467.467 0 100-.933.467.467 0 000 .933zm1.4.467a.467.467 0 11-.934 0 .467.467 0 01.934 0zm-2.334.466a.467.467 0 100-.933.467.467 0 000 .933zm-1.4-.466a.467.467 0 11-.933 0 .467.467 0 01.933 0zM1.4 4.233a.467.467 0 100-.933.467.467 0 000 .933zm1.4.467a.467.467 0 11-.933 0 .467.467 0 01.933 0zm1.4.467a.467.467 0 100-.934.467.467 0 000 .934zM6.533 4.7a.467.467 0 11-.933 0 .467.467 0 01.933 0zM7 6.1a.467.467 0 100-.933.467.467 0 000 .933zm-1.4-.467a.467.467 0 11-.933 0 .467.467 0 01.933 0zM3.267 6.1a.467.467 0 100-.933.467.467 0 000 .933zm-1.4-.467a.467.467 0 11-.934 0 .467.467 0 01.934 0z"
                                clip-rule="evenodd"
                              />
                            </g>
                          </g>
                          <defs>
                            <linearGradient
                              id="paint0_linear_343_121520"
                              x1=".933"
                              x2=".933"
                              y1="1.433"
                              y2="6.1"
                              gradientUnits="userSpaceOnUse"
                            >
                              <stop stop-color="#fff" />
                              <stop offset="1" stop-color="#F0F0F0" />
                            </linearGradient>
                            <filter
                              id="filter0_d_343_121520"
                              width="6.533"
                              height="5.667"
                              x=".933"
                              y="1.433"
                              color-interpolation-filters="sRGB"
                              filterUnits="userSpaceOnUse"
                            >
                              <feFlood
                                flood-opacity="0"
                                result="BackgroundImageFix"
                              />
                              <feColorMatrix
                                in="SourceAlpha"
                                result="hardAlpha"
                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                              />
                              <feOffset dy="1" />
                              <feColorMatrix
                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.06 0"
                              />
                              <feBlend
                                in2="BackgroundImageFix"
                                result="effect1_dropShadow_343_121520"
                              />
                              <feBlend
                                in="SourceGraphic"
                                in2="effect1_dropShadow_343_121520"
                                result="shape"
                              />
                            </filter>
                          </defs>
                        </svg>
                        +1
                        <svg
                          class="w-2.5 h-2.5 ms-2.5"
                          aria-hidden="true"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 10 6"
                        >
                          <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 1 4 4 4-4"
                          />
                        </svg>
                      </button>
                      <div
                        id="dropdown-phone"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-52 dark:bg-gray-700"
                      >
                        <ul
                          class="py-2 text-sm text-gray-700 dark:text-gray-200"
                          aria-labelledby="dropdown-phone-button"
                        >
                          <li>
                            <button
                              type="button"
                              class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                              role="menuitem"
                            >
                              <div class="inline-flex items-center">
                                <svg
                                  fill="none"
                                  aria-hidden="true"
                                  class="h-4 w-4 me-2"
                                  viewBox="0 0 20 15"
                                >
                                  <rect
                                    width="19.6"
                                    height="14"
                                    y=".5"
                                    fill="#fff"
                                    rx="2"
                                  />
                                  <mask
                                    id="a"
                                    style="mask-type: luminance"
                                    width="20"
                                    height="15"
                                    x="0"
                                    y="0"
                                    maskUnits="userSpaceOnUse"
                                  >
                                    <rect
                                      width="19.6"
                                      height="14"
                                      y=".5"
                                      fill="#fff"
                                      rx="2"
                                    />
                                  </mask>
                                  <g mask="url(#a)">
                                    <path
                                      fill="#D02F44"
                                      fill-rule="evenodd"
                                      d="M19.6.5H0v.933h19.6V.5zm0 1.867H0V3.3h19.6v-.933zM0 4.233h19.6v.934H0v-.934zM19.6 6.1H0v.933h19.6V6.1zM0 7.967h19.6V8.9H0v-.933zm19.6 1.866H0v.934h19.6v-.934zM0 11.7h19.6v.933H0V11.7zm19.6 1.867H0v.933h19.6v-.933z"
                                      clip-rule="evenodd"
                                    />
                                    <path
                                      fill="#46467F"
                                      d="M0 .5h8.4v6.533H0z"
                                    />
                                    <g filter="url(#filter0_d_343_121520)">
                                      <path
                                        fill="url(#paint0_linear_343_121520)"
                                        fill-rule="evenodd"
                                        d="M1.867 1.9a.467.467 0 11-.934 0 .467.467 0 01.934 0zm1.866 0a.467.467 0 11-.933 0 .467.467 0 01.933 0zm1.4.467a.467.467 0 100-.934.467.467 0 000 .934zM7.467 1.9a.467.467 0 11-.934 0 .467.467 0 01.934 0zM2.333 3.3a.467.467 0 100-.933.467.467 0 000 .933zm2.334-.467a.467.467 0 11-.934 0 .467.467 0 01.934 0zm1.4.467a.467.467 0 100-.933.467.467 0 000 .933zm1.4.467a.467.467 0 11-.934 0 .467.467 0 01.934 0zm-2.334.466a.467.467 0 100-.933.467.467 0 000 .933zm-1.4-.466a.467.467 0 11-.933 0 .467.467 0 01.933 0zM1.4 4.233a.467.467 0 100-.933.467.467 0 000 .933zm1.4.467a.467.467 0 11-.933 0 .467.467 0 01.933 0zm1.4.467a.467.467 0 100-.934.467.467 0 000 .934zM6.533 4.7a.467.467 0 11-.933 0 .467.467 0 01.933 0zM7 6.1a.467.467 0 100-.933.467.467 0 000 .933zm-1.4-.467a.467.467 0 11-.933 0 .467.467 0 01.933 0zM3.267 6.1a.467.467 0 100-.933.467.467 0 000 .933zm-1.4-.467a.467.467 0 11-.934 0 .467.467 0 01.934 0z"
                                        clip-rule="evenodd"
                                      />
                                    </g>
                                  </g>
                                  <defs>
                                    <linearGradient
                                      id="paint0_linear_343_121520"
                                      x1=".933"
                                      x2=".933"
                                      y1="1.433"
                                      y2="6.1"
                                      gradientUnits="userSpaceOnUse"
                                    >
                                      <stop stop-color="#fff" />
                                      <stop offset="1" stop-color="#F0F0F0" />
                                    </linearGradient>
                                    <filter
                                      id="filter0_d_343_121520"
                                      width="6.533"
                                      height="5.667"
                                      x=".933"
                                      y="1.433"
                                      color-interpolation-filters="sRGB"
                                      filterUnits="userSpaceOnUse"
                                    >
                                      <feFlood
                                        flood-opacity="0"
                                        result="BackgroundImageFix"
                                      />
                                      <feColorMatrix
                                        in="SourceAlpha"
                                        result="hardAlpha"
                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                      />
                                      <feOffset dy="1" />
                                      <feColorMatrix
                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.06 0"
                                      />
                                      <feBlend
                                        in2="BackgroundImageFix"
                                        result="effect1_dropShadow_343_121520"
                                      />
                                      <feBlend
                                        in="SourceGraphic"
                                        in2="effect1_dropShadow_343_121520"
                                        result="shape"
                                      />
                                    </filter>
                                  </defs>
                                </svg>
                                United States (+1)
                              </div>
                            </button>
                          </li>
                          <li>
                            <button
                              type="button"
                              class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                              role="menuitem"
                            >
                              <div class="inline-flex items-center">
                                <svg
                                  class="h-4 w-4 me-2"
                                  fill="none"
                                  viewBox="0 0 20 15"
                                >
                                  <rect
                                    width="19.6"
                                    height="14"
                                    y=".5"
                                    fill="#fff"
                                    rx="2"
                                  />
                                  <mask
                                    id="a"
                                    style="mask-type: luminance"
                                    width="20"
                                    height="15"
                                    x="0"
                                    y="0"
                                    maskUnits="userSpaceOnUse"
                                  >
                                    <rect
                                      width="19.6"
                                      height="14"
                                      y=".5"
                                      fill="#fff"
                                      rx="2"
                                    />
                                  </mask>
                                  <g mask="url(#a)">
                                    <path fill="#0A17A7" d="M0 .5h19.6v14H0z" />
                                    <path
                                      fill="#fff"
                                      fill-rule="evenodd"
                                      d="M-.898-.842L7.467 4.8V-.433h4.667V4.8l8.364-5.642L21.542.706l-6.614 4.46H19.6v4.667h-4.672l6.614 4.46-1.044 1.549-8.365-5.642v5.233H7.467V10.2l-8.365 5.642-1.043-1.548 6.613-4.46H0V5.166h4.672L-1.941.706-.898-.842z"
                                      clip-rule="evenodd"
                                    />
                                    <path
                                      stroke="#DB1F35"
                                      stroke-linecap="round"
                                      stroke-width=".667"
                                      d="M13.067 4.933L21.933-.9M14.009 10.088l7.947 5.357M5.604 4.917L-2.686-.67M6.503 10.024l-9.189 6.093"
                                    />
                                    <path
                                      fill="#E6273E"
                                      fill-rule="evenodd"
                                      d="M0 8.9h8.4v5.6h2.8V8.9h8.4V6.1h-8.4V.5H8.4v5.6H0v2.8z"
                                      clip-rule="evenodd"
                                    />
                                  </g>
                                </svg>
                                United Kingdom (+44)
                              </div>
                            </button>
                          </li>
                          <li>
                            <button
                              type="button"
                              class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                              role="menuitem"
                            >
                              <div class="inline-flex items-center">
                                <svg
                                  class="h-4 w-4 me-2"
                                  fill="none"
                                  viewBox="0 0 20 15"
                                  xmlns="http://www.w3.org/2000/svg"
                                >
                                  <rect
                                    width="19.6"
                                    height="14"
                                    y=".5"
                                    fill="#fff"
                                    rx="2"
                                  />
                                  <mask
                                    id="a"
                                    style="mask-type: luminance"
                                    width="20"
                                    height="15"
                                    x="0"
                                    y="0"
                                    maskUnits="userSpaceOnUse"
                                  >
                                    <rect
                                      width="19.6"
                                      height="14"
                                      y=".5"
                                      fill="#fff"
                                      rx="2"
                                    />
                                  </mask>
                                  <g mask="url(#a)">
                                    <path fill="#0A17A7" d="M0 .5h19.6v14H0z" />
                                    <path
                                      fill="#fff"
                                      stroke="#fff"
                                      stroke-width=".667"
                                      d="M0 .167h-.901l.684.586 3.15 2.7v.609L-.194 6.295l-.14.1v1.24l.51-.319L3.83 5.033h.73L7.7 7.276a.488.488 0 00.601-.767L5.467 4.08v-.608l2.987-2.134a.667.667 0 00.28-.543V-.1l-.51.318L4.57 2.5h-.73L.66.229.572.167H0z"
                                    />
                                    <path
                                      fill="url(#paint0_linear_374_135177)"
                                      fill-rule="evenodd"
                                      d="M0 2.833V4.7h3.267v2.133c0 .369.298.667.666.667h.534a.667.667 0 00.666-.667V4.7H8.2a.667.667 0 00.667-.667V3.5a.667.667 0 00-.667-.667H5.133V.5H3.267v2.333H0z"
                                      clip-rule="evenodd"
                                    />
                                    <path
                                      fill="url(#paint1_linear_374_135177)"
                                      fill-rule="evenodd"
                                      d="M0 3.3h3.733V.5h.934v2.8H8.4v.933H4.667v2.8h-.934v-2.8H0V3.3z"
                                      clip-rule="evenodd"
                                    />
                                    <path
                                      fill="#fff"
                                      fill-rule="evenodd"
                                      d="M4.2 11.933l-.823.433.157-.916-.666-.65.92-.133.412-.834.411.834.92.134-.665.649.157.916-.823-.433zm9.8.7l-.66.194.194-.66-.194-.66.66.193.66-.193-.193.66.193.66-.66-.194zm0-8.866l-.66.193.194-.66-.194-.66.66.193.66-.193-.193.66.193.66-.66-.193zm2.8 2.8l-.66.193.193-.66-.193-.66.66.193.66-.193-.193.66.193.66-.66-.193zm-5.6.933l-.66.193.193-.66-.193-.66.66.194.66-.194-.193.66.193.66-.66-.193zm4.2 1.167l-.33.096.096-.33-.096-.33.33.097.33-.097-.097.33.097.33-.33-.096z"
                                      clip-rule="evenodd"
                                    />
                                  </g>
                                  <defs>
                                    <linearGradient
                                      id="paint0_linear_374_135177"
                                      x1="0"
                                      x2="0"
                                      y1=".5"
                                      y2="7.5"
                                      gradientUnits="userSpaceOnUse"
                                    >
                                      <stop stop-color="#fff" />
                                      <stop offset="1" stop-color="#F0F0F0" />
                                    </linearGradient>
                                    <linearGradient
                                      id="paint1_linear_374_135177"
                                      x1="0"
                                      x2="0"
                                      y1=".5"
                                      y2="7.033"
                                      gradientUnits="userSpaceOnUse"
                                    >
                                      <stop stop-color="#FF2E3B" />
                                      <stop offset="1" stop-color="#FC0D1B" />
                                    </linearGradient>
                                  </defs>
                                </svg>
                                Australia (+61)
                              </div>
                            </button>
                          </li>
                          <li>
                            <button
                              type="button"
                              class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                              role="menuitem"
                            >
                              <div class="inline-flex items-center">
                                <svg
                                  class="w-4 h-4 me-2"
                                  fill="none"
                                  viewBox="0 0 20 15"
                                >
                                  <rect
                                    width="19.6"
                                    height="14"
                                    y=".5"
                                    fill="#fff"
                                    rx="2"
                                  />
                                  <mask
                                    id="a"
                                    style="mask-type: luminance"
                                    width="20"
                                    height="15"
                                    x="0"
                                    y="0"
                                    maskUnits="userSpaceOnUse"
                                  >
                                    <rect
                                      width="19.6"
                                      height="14"
                                      y=".5"
                                      fill="#fff"
                                      rx="2"
                                    />
                                  </mask>
                                  <g mask="url(#a)">
                                    <path
                                      fill="#262626"
                                      fill-rule="evenodd"
                                      d="M0 5.167h19.6V.5H0v4.667z"
                                      clip-rule="evenodd"
                                    />
                                    <g filter="url(#filter0_d_374_135180)">
                                      <path
                                        fill="#F01515"
                                        fill-rule="evenodd"
                                        d="M0 9.833h19.6V5.167H0v4.666z"
                                        clip-rule="evenodd"
                                      />
                                    </g>
                                    <g filter="url(#filter1_d_374_135180)">
                                      <path
                                        fill="#FFD521"
                                        fill-rule="evenodd"
                                        d="M0 14.5h19.6V9.833H0V14.5z"
                                        clip-rule="evenodd"
                                      />
                                    </g>
                                  </g>
                                  <defs>
                                    <filter
                                      id="filter0_d_374_135180"
                                      width="19.6"
                                      height="4.667"
                                      x="0"
                                      y="5.167"
                                      color-interpolation-filters="sRGB"
                                      filterUnits="userSpaceOnUse"
                                    >
                                      <feFlood
                                        flood-opacity="0"
                                        result="BackgroundImageFix"
                                      />
                                      <feColorMatrix
                                        in="SourceAlpha"
                                        result="hardAlpha"
                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                      />
                                      <feOffset />
                                      <feColorMatrix
                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.06 0"
                                      />
                                      <feBlend
                                        in2="BackgroundImageFix"
                                        result="effect1_dropShadow_374_135180"
                                      />
                                      <feBlend
                                        in="SourceGraphic"
                                        in2="effect1_dropShadow_374_135180"
                                        result="shape"
                                      />
                                    </filter>
                                    <filter
                                      id="filter1_d_374_135180"
                                      width="19.6"
                                      height="4.667"
                                      x="0"
                                      y="9.833"
                                      color-interpolation-filters="sRGB"
                                      filterUnits="userSpaceOnUse"
                                    >
                                      <feFlood
                                        flood-opacity="0"
                                        result="BackgroundImageFix"
                                      />
                                      <feColorMatrix
                                        in="SourceAlpha"
                                        result="hardAlpha"
                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                      />
                                      <feOffset />
                                      <feColorMatrix
                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.06 0"
                                      />
                                      <feBlend
                                        in2="BackgroundImageFix"
                                        result="effect1_dropShadow_374_135180"
                                      />
                                      <feBlend
                                        in="SourceGraphic"
                                        in2="effect1_dropShadow_374_135180"
                                        result="shape"
                                      />
                                    </filter>
                                  </defs>
                                </svg>
                                Germany (+49)
                              </div>
                            </button>
                          </li>
                          <li>
                            <button
                              type="button"
                              class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                              role="menuitem"
                            >
                              <div class="inline-flex items-center">
                                <svg
                                  class="w-4 h-4 me-2"
                                  fill="none"
                                  viewBox="0 0 20 15"
                                >
                                  <rect
                                    width="19.1"
                                    height="13.5"
                                    x=".25"
                                    y=".75"
                                    fill="#fff"
                                    stroke="#F5F5F5"
                                    stroke-width=".5"
                                    rx="1.75"
                                  />
                                  <mask
                                    id="a"
                                    style="mask-type: luminance"
                                    width="20"
                                    height="15"
                                    x="0"
                                    y="0"
                                    maskUnits="userSpaceOnUse"
                                  >
                                    <rect
                                      width="19.1"
                                      height="13.5"
                                      x=".25"
                                      y=".75"
                                      fill="#fff"
                                      stroke="#fff"
                                      stroke-width=".5"
                                      rx="1.75"
                                    />
                                  </mask>
                                  <g mask="url(#a)">
                                    <path
                                      fill="#F44653"
                                      d="M13.067.5H19.6v14h-6.533z"
                                    />
                                    <path
                                      fill="#1035BB"
                                      fill-rule="evenodd"
                                      d="M0 14.5h6.533V.5H0v14z"
                                      clip-rule="evenodd"
                                    />
                                  </g>
                                </svg>
                                France (+33)
                              </div>
                            </button>
                          </li>
                          <li>
                            <button
                              type="button"
                              class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                              role="menuitem"
                            >
                              <div class="inline-flex items-center">
                                <svg
                                  class="w-4 h-4 me-2"
                                  fill="none"
                                  viewBox="0 0 20 15"
                                >
                                  <rect
                                    width="19.6"
                                    height="14"
                                    y=".5"
                                    fill="#fff"
                                    rx="2"
                                  />
                                  <mask
                                    id="a"
                                    style="mask-type: luminance"
                                    width="20"
                                    height="15"
                                    x="0"
                                    y="0"
                                    maskUnits="userSpaceOnUse"
                                  >
                                    <rect
                                      width="19.6"
                                      height="14"
                                      y=".5"
                                      fill="#fff"
                                      rx="2"
                                    />
                                  </mask>
                                  <g mask="url(#a)">
                                    <path
                                      fill="#262626"
                                      fill-rule="evenodd"
                                      d="M0 5.167h19.6V.5H0v4.667z"
                                      clip-rule="evenodd"
                                    />
                                    <g filter="url(#filter0_d_374_135180)">
                                      <path
                                        fill="#F01515"
                                        fill-rule="evenodd"
                                        d="M0 9.833h19.6V5.167H0v4.666z"
                                        clip-rule="evenodd"
                                      />
                                    </g>
                                    <g filter="url(#filter1_d_374_135180)">
                                      <path
                                        fill="#FFD521"
                                        fill-rule="evenodd"
                                        d="M0 14.5h19.6V9.833H0V14.5z"
                                        clip-rule="evenodd"
                                      />
                                    </g>
                                  </g>
                                  <defs>
                                    <filter
                                      id="filter0_d_374_135180"
                                      width="19.6"
                                      height="4.667"
                                      x="0"
                                      y="5.167"
                                      color-interpolation-filters="sRGB"
                                      filterUnits="userSpaceOnUse"
                                    >
                                      <feFlood
                                        flood-opacity="0"
                                        result="BackgroundImageFix"
                                      />
                                      <feColorMatrix
                                        in="SourceAlpha"
                                        result="hardAlpha"
                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                      />
                                      <feOffset />
                                      <feColorMatrix
                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.06 0"
                                      />
                                      <feBlend
                                        in2="BackgroundImageFix"
                                        result="effect1_dropShadow_374_135180"
                                      />
                                      <feBlend
                                        in="SourceGraphic"
                                        in2="effect1_dropShadow_374_135180"
                                        result="shape"
                                      />
                                    </filter>
                                    <filter
                                      id="filter1_d_374_135180"
                                      width="19.6"
                                      height="4.667"
                                      x="0"
                                      y="9.833"
                                      color-interpolation-filters="sRGB"
                                      filterUnits="userSpaceOnUse"
                                    >
                                      <feFlood
                                        flood-opacity="0"
                                        result="BackgroundImageFix"
                                      />
                                      <feColorMatrix
                                        in="SourceAlpha"
                                        result="hardAlpha"
                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                      />
                                      <feOffset />
                                      <feColorMatrix
                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.06 0"
                                      />
                                      <feBlend
                                        in2="BackgroundImageFix"
                                        result="effect1_dropShadow_374_135180"
                                      />
                                      <feBlend
                                        in="SourceGraphic"
                                        in2="effect1_dropShadow_374_135180"
                                        result="shape"
                                      />
                                    </filter>
                                  </defs>
                                </svg>
                                Germany (+49)
                              </div>
                            </button>
                          </li>
                        </ul>
                      </div>
                      <label
                        for="phone-input"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"
                        >Phone number:</label
                      >
                      <div class="relative w-full">
                        <input
                          type="text"
                          id="phone-input"
                          class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-0 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                          pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                          placeholder="123-456-7890"
                          required
                        />
                      </div>
                    </div>
                  </div>

                  <div class="mb-6">
                    <label
                      for="password"
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      >Password</label
                    >
                    <input
                      type="password"
                      id="password"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="•••••••••"
                      required
                    />
                  </div>
                  <div class="flex items-start mb-6">
                    <div class="flex items-center h-5">
                      <input
                        id="remember"
                        type="checkbox"
                        value=""
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                        required
                      />
                    </div>
                    <label
                      for="remember"
                      class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                      >I agree to the
                      <a
                        href="#"
                        class="text-blue-600 hover:underline dark:text-blue-500"
                        >Terms of Use</a
                      >
                      and
                      <a
                        href="#"
                        class="text-blue-600 hover:underline dark:text-blue-500"
                        >Privacy Policy</a
                      >
                      and I am authorized to accept for my business.
                    </label>
                  </div>
                  <button
                    type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                  >
                    Submit
                  </button>
                </form>

                <div class="py-1 my-1 font-yaraa text-sm">
                  <a class="hover:text-yaraa-primary" href="/login"
                    >Click here to login as a supplier</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="w-6/12 bg-[#1F3946] relative hidden xl:block min-h-screen transition-all"
      >
        <svg
          width="447"
          height="450"
          viewBox="0 0 447 450"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <mask
            id="mask0_292_7324"
            style="mask-type: alpha"
            maskUnits="userSpaceOnUse"
            x="-117"
            y="0"
            width="564"
            height="563"
          >
            <rect
              width="563"
              height="563"
              transform="translate(-116.5)"
              fill="url(#paint0_radial_292_7324)"
            />
          </mask>
          <g mask="url(#mask0_292_7324)">
            <g clip-path="url(#clip0_292_7324)">
              <g clip-path="url(#clip1_292_7324)">
                <line
                  x1="27.8666"
                  x2="27.8666"
                  y2="563"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
                <line
                  x1="75.8666"
                  x2="75.8666"
                  y2="563"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
                <line
                  x1="123.867"
                  x2="123.867"
                  y2="563"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
                <line
                  x1="171.867"
                  x2="171.867"
                  y2="563"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
                <line
                  x1="219.867"
                  x2="219.867"
                  y2="563"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
                <line
                  x1="267.867"
                  x2="267.867"
                  y2="563"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
                <line
                  x1="315.867"
                  x2="315.867"
                  y2="563"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
                <line
                  x1="363.867"
                  x2="363.867"
                  y2="563"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
                <line
                  x1="411.867"
                  x2="411.867"
                  y2="563"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
              </g>
              <rect
                x="-116.133"
                y="0.366536"
                width="767.267"
                height="562.267"
                stroke="#EAECF0"
                stroke-width="0.733073"
              />
              <g clip-path="url(#clip2_292_7324)">
                <line
                  x1="-116.5"
                  y1="47.6335"
                  x2="446.5"
                  y2="47.6335"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
                <line
                  x1="-116.5"
                  y1="95.6335"
                  x2="446.5"
                  y2="95.6335"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
                <line
                  x1="-116.5"
                  y1="143.633"
                  x2="446.5"
                  y2="143.633"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
                <line
                  x1="-116.5"
                  y1="191.633"
                  x2="446.5"
                  y2="191.633"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
                <line
                  x1="-116.5"
                  y1="239.633"
                  x2="446.5"
                  y2="239.633"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
                <line
                  x1="-116.5"
                  y1="287.633"
                  x2="446.5"
                  y2="287.633"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
                <line
                  x1="-116.5"
                  y1="335.633"
                  x2="446.5"
                  y2="335.633"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
                <line
                  x1="-116.5"
                  y1="383.633"
                  x2="446.5"
                  y2="383.633"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
                <line
                  x1="-116.5"
                  y1="431.633"
                  x2="446.5"
                  y2="431.633"
                  stroke="#EAECF0"
                  stroke-width="0.733073"
                />
              </g>
              <rect
                x="-116.133"
                y="0.366536"
                width="562.267"
                height="767.267"
                stroke="#EAECF0"
                stroke-width="0.733073"
              />
            </g>
          </g>
          <defs>
            <radialGradient
              id="paint0_radial_292_7324"
              cx="0"
              cy="0"
              r="1"
              gradientUnits="userSpaceOnUse"
              gradientTransform="translate(281.5 281.5) rotate(90) scale(281.5 281.5)"
            >
              <stop />
              <stop offset="1" stop-opacity="0" />
            </radialGradient>
            <clipPath id="clip0_292_7324">
              <rect
                width="768"
                height="563"
                fill="white"
                transform="translate(-116.5)"
              />
            </clipPath>
            <clipPath id="clip1_292_7324">
              <rect x="-116.5" width="768" height="563" fill="white" />
            </clipPath>
            <clipPath id="clip2_292_7324">
              <rect x="-116.5" width="563" height="768" fill="white" />
            </clipPath>
          </defs>
        </svg>

        <img
          alt="reg-bg-slide-one"
          srcset="
            https://images.pexels.com/photos/9978028/pexels-photo-9978028.jpeg&amp;w=640&amp;q=75  1x,
            https://images.pexels.com/photos/9978028/pexels-photo-9978028.jpeg&amp;w=1200&amp;q=75 2x
          "
          src="https://images.pexels.com/photos/9978028/pexels-photo-9978028.jpeg&amp;w=1200&amp;q=75"
          width="559"
          height="1024"
          decoding="async"
          data-nimg="1"
          class="h-screen bg-cover transition-all absolute top-0 left-0 ease-in-out translate-x-0"
          loading="lazy"
          style="color: transparent"
        />
        <div
          class="reg-slider-btn-container absolute bottom-0 left-[10%] right-0 max-w-[80%] p-8 flex flex-col justify-between"
        >
          <div class="w-[95%]">
            <h1 class="text-c-five text-2xl font-extrabold mb-5">
              What to expect when <br />
              you create an account
            </h1>
            <div>
              <h3 class="text-c-black-gray text-lg font-semibold">
                International visibility - for free
              </h3>
              <p class="text-c-black-four text-base font-normal">
                All our free accounts have access to a growing network of
                companies across the globe.
              </p>
            </div>
          </div>
          <div class="w-[95%]">
            <div class="flex gap-x-1 items-center">
              <button class="gray-dots w-[10px] h-[10px]"></button
              ><button class="green-dots w-[10px] h-[10px]"></button
              ><button class="gray-dots w-[10px] h-[10px]"></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>