export function useInputValidation() {
  const validateInput = (value, regex, maxLength = Infinity) => {
    let formattedValue = value.trim();
    // Apply the regex pattern to format the value
    formattedValue = formattedValue.replace(regex, '');

    // Limit the length of the value
    if (maxLength !== Infinity && formattedValue.length > maxLength) {
      formattedValue = formattedValue.slice(0, maxLength);
    }

    return formattedValue;
  }

  return {
    validateInput
  };
}
