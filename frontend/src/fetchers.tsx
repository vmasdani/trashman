export const fetchUsers = async () => {
  try {
    const resp = await fetch(`${import.meta.env.VITE_APP_BASE_URL}/api/users`);

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return (await resp.json()) as any[];
  } catch (e) {
    return [];
  }
};

export const fetchUser = async (params: { id: any }) => {
  try {
    const resp = await fetch(
      `${import.meta.env.VITE_APP_BASE_URL}/api/users/${params.id}`
    );

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return (await resp.json()) as any;
  } catch (e) {
    return null;
  }
};

export const fetchPartners = async () => {
  try {
    const resp = await fetch(
      `${import.meta.env.VITE_APP_BASE_URL}/api/partners`
    );

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return (await resp.json()) as any[];
  } catch (e) {
    return [];
  }
};

export const fetchPartner = async (params: { id: any }) => {
  try {
    const resp = await fetch(
      `${import.meta.env.VITE_APP_BASE_URL}/api/partners/${params.id}`
    );

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return (await resp.json()) as any;
  } catch (e) {
    return null;
  }
};

export const fetchMaterials = async () => {
  try {
    const resp = await fetch(
      `${import.meta.env.VITE_APP_BASE_URL}/api/materials`
    );

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return (await resp.json()) as any[];
  } catch (e) {
    return [];
  }
};

export const fetchMaterial = async (params: { id: any }) => {
  try {
    const resp = await fetch(
      `${import.meta.env.VITE_APP_BASE_URL}/api/materials/${params.id}`
    );

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return (await resp.json()) as any;
  } catch (e) {
    return null;
  }
};

export const fetchPurchases = async () => {
  try {
    const resp = await fetch(
      `${import.meta.env.VITE_APP_BASE_URL}/api/purchases`
    );

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return (await resp.json()) as any[];
  } catch (e) {
    return [];
  }
};

export const fetchPurchase = async (params: { id: any }) => {
  try {
    const resp = await fetch(
      `${import.meta.env.VITE_APP_BASE_URL}/api/purchases/${params.id}`
    );

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return (await resp.json()) as any;
  } catch (e) {
    return null;
  }
};

export const fetchSales = async () => {
  try {
    const resp = await fetch(`${import.meta.env.VITE_APP_BASE_URL}/api/sales`);

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return (await resp.json()) as any[];
  } catch (e) {
    return [];
  }
};

export const fetchSale = async (params: { id: any }) => {
  try {
    const resp = await fetch(
      `${import.meta.env.VITE_APP_BASE_URL}/api/sales/${params.id}`
    );

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return (await resp.json()) as any;
  } catch (e) {
    return null;
  }
};
